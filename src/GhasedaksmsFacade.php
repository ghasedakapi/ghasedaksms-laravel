<?php

namespace Ghasedaksms\GhasedaksmsLaravel;

use Ghasedak\GhasedaksmsApi;
use Illuminate\Support\Facades\Facade;

/**
 * @see GhasedaksmsApi
 */
class GhasedaksmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ghasedaksms';
    }
}
