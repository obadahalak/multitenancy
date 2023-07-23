<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Facade\Tenant as TenantFacade;
use App\Models\Relations\Motators;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\ActiveServiceScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyService extends Model
{
    use HasFactory , Motators;
    protected $table = 'my_servies';

    protected $guarded = [];


    public static function  booted(){
        static::addGlobalScope(new ActiveServiceScope);
    }

}
