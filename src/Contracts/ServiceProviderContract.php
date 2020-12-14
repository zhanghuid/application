<?php

namespace Huid\Application\Contracts;

use Huid\Application\Kernel;

interface ServiceProviderContract
{
    public function register(Kernel $kernel);
}