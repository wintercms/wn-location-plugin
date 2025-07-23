<?php namespace Winter\Location;

use Backend;
use System\Classes\PluginBase;

/**
 * Location Plugin
 *
 * Location based features, such as Country and State
 *
 * @author Alexey Bobkov, Samuel Georges (original plugin)
 * @author Winter CMS
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritDoc}
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'winter.location::lang.plugin.name',
            'description' => 'winter.location::lang.plugin.description',
            'author'      => 'Winter CMS',
            'icon'        => 'icon-globe',
            'homepage'    => 'https://github.com/wintercms/wn-location-plugin',
            'replaces'    => ['RainLab.Location' => '^1.1.6'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function registerSettings()
    {
        return [
            'location' => [
                'label'       => 'winter.location::lang.locations.menu_label',
                'description' => 'winter.location::lang.locations.menu_description',
                'category'    => 'winter.location::lang.plugin.name',
                'icon'        => 'icon-globe',
                'url'         => Backend::url('winter/location/locations'),
                'order'       => 500,
                'permissions' => ['winter.location.access_settings'],
                'keywords'    => 'country, countries, state',
            ],
            'settings' => [
                'label'       => 'winter.location::lang.settings.menu_label',
                'description' => 'winter.location::lang.settings.menu_description',
                'category'    => 'winter.location::lang.plugin.name',
                'icon'        => 'icon-map-signs',
                'class'       => 'Winter\Location\Models\Setting',
                'order'       => 600,
                'permissions' => ['winter.location.access_settings'],
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function registerComponents()
    {
        return [
            'Winter\Location\Components\LocationPicker' => 'locationPicker',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function registerPermissions()
    {
        return [
            'winter.location.access_settings' => ['tab' => 'winter.location::lang.plugin.name', 'label' => 'winter.location::lang.permissions.settings'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'form_select_country' => ['Winter\Location\Models\Country', 'formSelect'],
                'form_select_state'   => ['Winter\Location\Models\State', 'formSelect']
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function registerFormWidgets()
    {
        return [
            'Winter\Location\FormWidgets\AddressFinder' => [
                'label' => 'Address Finder',
                'code'  => 'addressfinder'
            ]
        ];
    }
}
