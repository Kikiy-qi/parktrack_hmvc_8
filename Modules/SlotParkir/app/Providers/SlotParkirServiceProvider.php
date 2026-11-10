<?php

namespace Modules\SlotParkir\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SlotParkirServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SlotParkir';

    protected string $nameLower = 'slotparkir';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
