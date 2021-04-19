<?php namespace Winter\Location;

use Backend;
use System\Classes\PluginBase;

/**
 * Location Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'winter.location::lang.plugin.name',
            'description' => 'winter.location::lang.plugin.description',
            'author'      => 'Winter CMS',
            'icon'        => 'icon-globe',
            'homepage'    => 'https://github.com/wintercms/wn-location-plugin',
            'replaces'    => ['RainLab.Location' => '<= 1.1.6'],
        ];
    }

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

    public function registerPermissions()
    {
        return [
            'winter.location.access_settings' => ['tab' => 'winter.location::lang.plugin.name', 'label' => 'winter.location::lang.permissions.settings'],
        ];
    }

    /**
     * Register new Twig variables
     * @return array
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
     * Registers any form widgets implemented in this plugin.
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
