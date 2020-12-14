<?php

namespace Huid\Application;

use Closure;
use Tightenco\Collect\Support\Collection;

class Config
{
    protected static $instance = null;

    protected $plugins;
    protected $binds;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->plugins = new Collection();
        $this->binds = new Collection();
    }


    /**
     * Get the Config instance
     *
     * @return null|Config
     */
    public static function getInstance()
    {
        self::$instance || self::$instance = new self();
        return self::$instance;
    }

    /**
     * Global installation plugin
     *
     * @param $plugins
     * @param array ...$opt
     * @return $this
     */
    public function use($plugins, ...$opt)
    {
        if (is_string($plugins)) {
            $this->plugins->push([$plugins, $opt]);
        } else {
            $this->plugins = $this->plugins->merge($plugins);
        }
        return $this;
    }

    /**
     * Global binding custom method
     *
     * @param string $name
     * @param Closure $provider
     * @return $this
     */
    public function bind(string $name, Closure $provider)
    {
        $this->binds[$name] = $provider;
        return $this;
    }

    public function bootstrap(Application $application)
    {
        $this->installPlugins($application);
        $this->installBind($application);
    }

    protected function installPlugins(Application $application)
    {
        $this->plugins->each(function ($plugin) use ($application) {
            if (is_string($plugin)) {
                $application->use($plugin);
            } else {
                $application->use($plugin[0], ...$plugin[1]);
            }
        });
    }

    protected function installBind(Application $application)
    {
        $this->binds->each(function ($provider, $name) use ($application) {
            $application->bind($name, $provider);
        });
    }

}