<?php
namespace Huid\Application\Providers;

use Huid\Application\Services\PluginService;
use Huid\Application\Contracts\ServiceProviderContract;
use Huid\Application\Kernel;

class PluginServiceProvider implements ServiceProviderContract
{
    public function register(Kernel $kernel)
    {
        $kernel->bind('use', function ($plugins, ...$opt) {
            return PluginService::install($this, $plugins, ...$opt);
        });
    }

}