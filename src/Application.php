<?php

namespace Huid\Application;

use Huid\Application\Kernel;
use Tightenco\Collect\Support\Collection;
use Closure;


/**
 * Class Application
 * @package Huid\Application
 *
 * @method use ($plugins, ...$opt)
 */
class Application
{
    protected $application;
    protected $kernel;
    protected static $instance = null;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->kernel = (new Kernel($this))->bootstrap();
        Config::getInstance()->bootstrap($this);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->application, $name)) {
            $result = $this->application->$name(...$arguments);
        } else {
            $result = $this->kernel->getService($name)->call($this, ...$arguments);
        }
        return $result;
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return $instance->$name(...$arguments);
    }

    public function __destruct()
    {
        $this->destruct();
    }

    /**
     * Get the Application single instance
     *
     * @return
     */
    public static function getInstance()
    {
        self::$instance || self::$instance = new self();
        return self::$instance;
    }

    /**
     * Get the Config instance
     * @return null|Config
     */
    public static function config()
    {
        return Config::getInstance();
    }

    /**
     * Destruction of resources
     */
    public function destruct()
    {
        unset($this->application);
        unset($this->kernel);
    }


    /**
     * Bind a custom method to the Application object
     *
     * @param string $name Invoking the name
     * @param Closure $provide Called method
     * @return $this
     */
    public function bind(string $name, Closure $provide)
    {
        $this->kernel->bind($name, $provide);
        return $this;
    }

}