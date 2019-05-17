<?php

namespace MyVendor\MyPackage\Facades;

use Illuminate\Support\Facades\Facade;

class MyPackage extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mypackage';
    }
}
