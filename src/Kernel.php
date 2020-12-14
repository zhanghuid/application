<?php

namespace Huid\Application;

use Huid\Application\Contracts\ServiceProviderContract;
use Huid\Application\Exceptions\ServiceNotFoundException;
use Huid\Application\Providers\PluginServiceProvider;
use Tightenco\Collect\Support\Collection;

class Kernel
{
    protected $providers = [
        PluginServiceProvider::class
    ];

    protected $binds;
    protected $application;

    /**
     * Kernel constructor.
     * @param $ql
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->binds = new Collection();
    }

    public function bootstrap()
    {
        //注册服务提供者
        $this->registerProviders();
        return $this;
    }

    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    public function bind(string $name, \Closure $provider)
    {
        $this->binds[$name] = $provider;
    }

    public function getService(string $name)
    {
        if (!$this->binds->offsetExists($name)) {
            throw new ServiceNotFoundException("Service: {$name} not found!");
        }
        return $this->binds[$name];
    }

    private function register(ServiceProviderContract $instance)
    {
        $instance->register($this);
    }


}