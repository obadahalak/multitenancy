<?php

namespace App\Models;


use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $connection='mysql';

    const SMALL=1;
    const BIG=2;

}
