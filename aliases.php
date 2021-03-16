<?php
/**
 * To allow compatibility with plugins that extend the original RainLab.Location plugin, this will alias those classes to
 * use the new Winter.Location classes.
 */
$aliases = [
    // Regular aliases
    Winter\Location\Plugin::class                     => 'RainLab\Location\Plugin',
    Winter\Location\Controllers\Locations::class      => 'RainLab\Location\Controllers\Locations',
    Winter\Location\FormWidgets\AddressFinder::class  => 'RainLab\Location\FormWidgets\AddressFinder',
    Winter\Location\Models\State::class               => 'RainLab\Location\Models\State',
    Winter\Location\Models\Setting::class             => 'RainLab\Location\Models\Setting',
    Winter\Location\Models\Country::class             => 'RainLab\Location\Models\Country',
];

foreach ($aliases as $original => $alias) {
    if (!class_exists($alias)) {
        class_alias($original, $alias);
    }
}
