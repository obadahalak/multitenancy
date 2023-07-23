<?php

namespace App\Services;

use App\Models\MyService;
use App\Models\Service;
use Exception;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TenantService
{
    public static $name = '';
    public static  function switchTenant($tenant)
    {


        if (!$tenant instanceof Tenant) {
            throw  ValidationException::withMessages(['error']);
        }

        $databaseName = $tenant->database;

        DB::purge('tenant');
        DB::purge('mysql');
        config(['database.connections.tenant.database' => $databaseName]);
        app('db')->setDefaultConnection('tenant');
        self::$name = $tenant->name;
    }

    public static function DefaultConnection()
    {

        DB::purge('tenant');
        DB::purge('mysql');

        DB::setDefaultConnection('mysql');
        app('db')->setDefaultConnection('mysql');
    }

    public function getName()
    {
        return self::$name;
    }

    public  function getMyOffer()
    {
        return MyService::first()->service_id;
    }






}
