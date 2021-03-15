<?php

if (!class_exists(RainLab\Location\Plugin::class)) {
    class_alias(Winter\Location\Plugin::class, RainLab\Location\Plugin::class);

    class_alias(Winter\Location\Controllers\Locations::class, RainLab\Location\Controllers\Locations::class);

    class_alias(Winter\Location\FormWidgets\AddressFinder::class, RainLab\Location\FormWidgets\AddressFinder::class);

    class_alias(Winter\Location\Models\State::class, RainLab\Location\Models\State::class);
    class_alias(Winter\Location\Models\Setting::class, RainLab\Location\Models\Setting::class);
    class_alias(Winter\Location\Models\Country::class, RainLab\Location\Models\Country::class);
}
