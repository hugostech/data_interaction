<?php
/**
 * Created by PhpStorm.
 * User: hankunwang
 * Date: 15/04/18
 * Time: 9:04 PM
 */

namespace Hugostech\Data_interaction;


use Illuminate\Support\Facades\Facade;

class DI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DI';
    }
}