<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * @method static void  switchTenant($tenant)
 *
 *  @method static void getName() get tenant name ^_^
 *  @method  getMyOffer() get my offer  ^_^
 *  @method  numberOfAvilableUsers()    ^_^
 */
class Tenant extends Facade{

    public static function getFacadeAccessor(){
        return 'Tenant';
    }
}
