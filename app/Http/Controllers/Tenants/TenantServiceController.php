<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use App\Models\Service;
use App\Models\MyService;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Facade\Tenant as TenantFacade;
use App\Http\Resources\Tenant\ServiceResource;

class TenantServiceController extends Controller
{



    public function services()
    {
        TenantFacade::switchTenant(auth('tenant')->user());
        $data = MyService::with('service')->get();

        return ServiceResource::collection($data);
    }
}
