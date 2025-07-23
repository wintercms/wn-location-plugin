<?php 

namespace Winter\Location\Models;

use Exception;
use Form;
use Http;
use Winter\Storm\Database\Model;

/**
 * Country Model
 */
class Country extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_location_countries';

    /**
     * @var array Behaviours implemented by this model.
     */
    public $implement = ['@Winter.Translate.Behaviors.TranslatableModel'];

    /**
     * @var array The translatable table fields.
     */
    public $translatable = ['name'];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name', 'code'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'code' => 'unique',
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'states' => ['Winter\Location\Models\State']
    ];

    /**
     * @var bool Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var array Cache for nameList() method
     */
    protected static $nameList = null;

    /**
     * @var array Cache for ISO attributes
     */
    protected static $iso = null;

    public static function getNameList()
    {
        if (self::$nameList) {
            return self::$nameList;
        }

        return self::$nameList = self::isEnabled()->orderBy('is_pinned', 'desc')->orderBy('name', 'asc')->lists('name', 'id');
    }

    public static function formSelect($name, $selectedValue = null, $options = [])
    {
        return Form::select($name, self::getNameList(), $selectedValue, $options);
    }

    public function scopeIsEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    public static function getDefault()
    {
        return ($defaultId = Setting::get('default_country'))
            ? static::find($defaultId)
            : null;
    }

    /**
     * Attempts to find a country from the IP address.
     * @param string $ipAddress
     * @return self
     */
    public static function getFromIp($ipAddress)
    {
        try {
            $body = (string) Http::get('http://ip2c.org/?ip='.$ipAddress);

            if (substr($body, 0, 1) === '1') {
                $code = explode(';', $body)[1];
                return static::where('code', $code)->first();
            }
        }
        catch (Exception $e) {}
    }

    /**
     * Return all ISO 3166-1 attributes
     *
     * @return array
     */
    public function getIsoAttribute(): array
    {
        if (self::$iso) {
            return self::$iso;
        }

        return self::$iso = (new \League\ISO3166\ISO3166)->alpha2($this->code);
    }

    /**
     * Return ISO 3166-1 country name
     *
     * @return string|null
     */
    public function getIsoNameAttribute(): ?string
    {
        return self::getIsoAttribute()['name'];
    }

    /**
     * Return ISO 3166-1 alpha-3 code (three-letter)
     *
     * @return string|null
     */
    public function getIsoAlpha3Attribute(): ?string
    {
        return self::getIsoAttribute()['alpha3'];
    }

    /**
     * Return ISO 3166-1 numeric country code (three-digit)
     *
     * @return string|null
     */
    public function getIsoNumericAttribute(): ?string
    {
        return self::getIsoAttribute()['numeric'];
    }

    /**
     * Return ISO 3166-1 currencies code (three-digit)
     *
     * @return array
     */
    public function getIsoCurrenciesAttribute(): array
    {
        return self::getIsoAttribute()['currency'];
    }
}
