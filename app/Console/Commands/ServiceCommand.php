<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Facade\Tenant;
use App\Models\MyService;
use App\Models\Tenant as ModelsTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function switchToTenant()
    {
        $tenants = ModelsTenant::get();
        foreach ($tenants as $tenant) {
            Tenant::switchTenant($tenant);
            $this->cheackTenantService();
        }
        $this->info('cheack Tenant Service completed successfully');
    }

    public function cheackTenantService()
    {
        $services = MyService::with('service')->get();

        foreach ($services as $service) {
            $StaredDateOfService = Carbon::parse($service->created_at);
            if ( Carbon::now() >= $StaredDateOfService->addMonths($service->service->duration)) {
                $service->update(['status' => false]);
            }
        }
    }
    public function handle()
    {

        $this->switchToTenant();
    }
}
