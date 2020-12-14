<?php

namespace Huid\Application\Plugins;

use Huid\Application\Application;
use Huid\Application\Contracts\PluginContract;

class HelloWorld implements PluginContract
{

    public static function install(Application $application, ...$opt)
    {
        $application->bind('hello', function () {
            return 'hello world plugin';
        });
    }
}