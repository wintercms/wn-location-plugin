<?php

namespace Winter\Location\Components;

use Cms\Classes\ComponentBase;
use Winter\Location\Models\Country;

/**
 * Location Picker component.
 *
 * Provides a simple mechanism for adding country and state fields to your front-end forms.
 *
 * @author Winter CMS
 */
class LocationPicker extends ComponentBase
{
    /**
     * @var Country Selected country.
     */
    protected ?Country $selectedCountry = null;

    /**
     * {@inheritDoc}
     */
    public function componentDetails()
    {
        return [
            'name'        => 'winter.location::lang.locationPicker.name',
            'description' => 'winter.location::lang.locationPicker.description',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function defineProperties()
    {
        return [
            'selectedCountry' => [
                'title'       => 'winter.location::lang.locationPicker.selectedCountry.title',
                'description' => 'winter.location::lang.locationPicker.selectedCountry.description',
                'type'        => 'dropdown',
                'default'     => '',
            ],
            'countryFieldName' => [
                'title'       => 'winter.location::lang.locationPicker.countryFieldName.title',
                'description' => 'winter.location::lang.locationPicker.countryFieldName.description',
                'type'        => 'string',
                'default'     => 'country_id',
                'group'       => 'winter.location::lang.locationPicker.group.fields',
            ],
            'stateFieldName' => [
                'title'       => 'winter.location::lang.locationPicker.stateFieldName.title',
                'description' => 'winter.location::lang.locationPicker.stateFieldName.description',
                'type'        => 'string',
                'default'     => 'state_id',
                'group'       => 'winter.location::lang.locationPicker.group.fields',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function onRun()
    {
        $this->page['countryId'] = post($this->property('countryFieldName'), $this->getSelectedCountry()?->id);
        $this->page['stateId'] = post($this->property('stateFieldName'));
        $this->page['selectedCountryId'] = $this->getSelectedCountry()?->id;
    }

    /**
     * Handler for when the country is changed.
     */
    public function onChangeCountry()
    {
        $this->page['countryId'] = post($this->property('countryFieldName'), $this->getSelectedCountry()?->id);
    }

    /**
     * Gets the selected country from the component properties.
     *
     * The country may be specified as an ID, or as a country code or name.
     *
     * @return Country|null
     */
    public function getSelectedCountry()
    {
        $selectedCountry = $this->property('selectedCountry');

        if (is_null($selectedCountry)) {
            return null;
        }

        if (!is_null($this->selectedCountry)) {
            return $this->selectedCountry;
        }

        if (is_string($selectedCountry) && preg_match('/^[1-9][0-9]+$/', $selectedCountry) === false) {
            return $this->selectedCountry = Country::where('code', $selectedCountry)->orWhere('name', $selectedCountry)->first();
        }

        return $this->selectedCountry = Country::find($selectedCountry);
    }

    /**
     * Country options provider.
     *
     * @return array
     */
    public function getSelectedCountryOptions()
    {
        $options = ['' => 'No country selected'];

        foreach (Country::getNameList() as $id => $name) {
            $options[$id] = $name;
        }

        return $options;
    }
}
