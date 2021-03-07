<?php namespace Winter\Location\Models;

use Form;
use Model;

/**
 * State Model
 */
class State extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_location_states';

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
        'code' => 'required',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'country' => ['Winter\Location\Models\Country']
    ];

    /**
     * @var bool Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var array Cache for nameList() method
     */
    protected static $nameList = [];

    public static function getNameList($countryId)
    {
        if (isset(self::$nameList[$countryId])) {
            return self::$nameList[$countryId];
        }

        return self::$nameList[$countryId] = self::whereCountryId($countryId)->isEnabled()->orderBy('name', 'asc')->lists('name', 'id');
    }

    public function scopeIsEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    public static function formSelect($name, $countryId = null, $selectedValue = null, $options = [])
    {
        return Form::select($name, self::getNameList($countryId), $selectedValue, $options);
    }

    public static function getDefault()
    {
        return ($defaultId = Setting::get('default_state'))
            ? static::find($defaultId)
            : null;
    }
}
