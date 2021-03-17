<?php

use Winter\Storm\Support\ClassLoader;

/**
 * To allow compatibility with plugins that extend the original RainLab.Location plugin, this will alias those classes to
 * use the new Winter.Location classes.
 */
$aliases = [
    // Regular aliases
    Winter\Location\Plugin::class                     => RainLab\Location\Plugin::class,
    Winter\Location\Controllers\Locations::class      => RainLab\Location\Controllers\Locations::class,
    Winter\Location\FormWidgets\AddressFinder::class  => RainLab\Location\FormWidgets\AddressFinder::class,
    Winter\Location\Models\State::class               => RainLab\Location\Models\State::class,
    Winter\Location\Models\Setting::class             => RainLab\Location\Models\Setting::class,
    Winter\Location\Models\Country::class             => RainLab\Location\Models\Country::class,
];

app(ClassLoader::class)->addAliases($aliases);
