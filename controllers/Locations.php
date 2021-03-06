<?php namespace Winter\Location\Controllers;

use Lang;
use Flash;
use Backend;
use BackendMenu;
use Winter\Location\Models\Country;
use Winter\Location\Models\State;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;

/**
 * Locations Back-end Controller
 */
class Locations extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['winter.location.access_settings'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.System', 'system', 'settings');
        SettingsManager::setContext('Winter.Location', 'location');
    }

    /**
     * {@inheritDoc}
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->is_enabled) {
            return 'safe disabled';
        }
    }

    public function relationExtendViewWidget($widget)
    {
        $widget->bindEvent('list.injectRowClass', function ($record) {
            if (!$record->is_enabled) {
                return 'safe disabled';
            }
        });
    }

    public function onLoadDisableForm()
    {
        try {
            $this->vars['checked'] = post('checked');
            $this->vars['location_type'] = post('location_type');
        }
        catch (Exception $ex) {
            $this->handleError($ex);
        }

        return $this->makePartial('disable_form');
    }

    public function onDisableLocations()
    {
        $enable = post('enable', false);

        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $objectId) {
                $object = null;
                switch (post('location_type')) {
                    case 'country':
                        $object = Country::find($objectId);
                        break;
                    case 'state':
                        $object = State::find($objectId);
                        break;
                }
                
                if (!$object) {
                    continue;
                }

                $object->is_enabled = $enable;
                $object->save();
            }

        }

        if ($enable) {
            Flash::success(Lang::get('winter.location::lang.locations.enable_success'));
        }
        else {
            Flash::success(Lang::get('winter.location::lang.locations.disable_success'));
        }

        return redirect()->refresh();
    }

    public function onLoadUnpinForm()
    {
        try {
            $this->vars['checked'] = post('checked');
        }
        catch (Exception $ex) {
            $this->handleError($ex);
        }

        return $this->makePartial('unpin_form');
    }

    public function onUnpinLocations()
    {
        $pin = post('pin', false);

        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $objectId) {
                if (!$object = Country::find($objectId)) {
                    continue;
                }

                $object->is_pinned = $pin;
                $object->save();
            }

        }

        if ($pin) {
            Flash::success(Lang::get('winter.location::lang.locations.pin_success'));
        }
        else {
            Flash::success(Lang::get('winter.location::lang.locations.unpin_success'));
        }

        return Backend::redirect('winter/location/locations');
    }
}
