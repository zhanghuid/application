<?php

namespace Huid\Application\Services;


use Huid\Application\Application;

class PluginService
{
    public static function install(Application $application, $plugins, ...$opt)
    {
        if (is_array($plugins)) {
            foreach ($plugins as $plugin) {
                $plugin::install($application);
            }
        } else {
             $plugins::install($application, ...$opt);
        }
        return $application;
    }
}