<?php

namespace Modules\Pengaduan\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class PengaduanServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Pengaduan';

    protected string $nameLower = 'pengaduan';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
