<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Tenant extends Authenticatable
{
    use HasFactory , HasApiTokens;
    protected $table='tenants';

    public  function getAmmount(){
        return $this->ammount;
    }


}
