<?php

namespace Huid\Application\Contracts;

use Huid\Application\Application;

interface PluginContract
{
    public static function install(Application $application, ...$opt);
}