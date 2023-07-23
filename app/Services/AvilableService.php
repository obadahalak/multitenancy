<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Service;
use App\Models\MyService;
use App\Facade\Tenant as tenantF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Facade\Tenant as FacadeTenant;
use App\Facade\Tenant as TenantFacade;
use App\Facade\Tenant as TeanantFacade;
use Illuminate\Validation\ValidationException;

trait AvilableService
{
    public function service(array|string $service)
    {

        if (is_string($service))
            return   MyService::whereBelongsTo(Service::where('name', $service)->first())->first();


        return MyService::whereBelongsTo(Service::whereIn('name', $service)->get())->get();
    }

    public  function numberOfAvilableUsers()
    {
        $numbers = match (TenantFacade::getMyOffer()) {
            Service::SMALL => 13,
            Service::BIG => 200,
        };
        return $numbers;
    }
    public function checkIfAvilableCreateUser()
    {
        $countUsers = User::getCountOfUsers();
        if ($countUsers < $this->numberOfAvilableUsers())
            return true;
        return false;
    }

    public function checkOfAvilableToBlockUser()
    {
        $check = match (TenantFacade::getMyOffer()) {
            Service::SMALL => false,
            Service::BIG => true,
        };
        return $check;
    }

    }
