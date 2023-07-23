<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use App\Facade\Tenant as TenantFacade;

use function PHPUnit\Framework\isNull;

class TenantMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migration for all tenants';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function seeder($id = null)
    {
        TenantService::DefaultConnection();
        if (isNull($id)) {
            $tenants = Tenant::get();
            foreach ($tenants as $tenant) {
                $this->info('started seeder for : ' . $tenant->name);
                TenantService::switchTenant($tenant);
                Artisan::call('db:seed',['--class'=>'Database\\Seeders\\Tenants\\TenantSeeder'
                                    , '--database=tenant']);
                Artisan::output();
                $this->info('seeding completed for all tenants ^_^');
            }
        return Command::SUCCESS;
        }

        $tenant=Tenant::find($id);
        if($tenant){
            TenantService::switchTenant($tenant);
            Artisan::call('db:seed --path=Database/Seeders/Tenants/TenantSeeder --database=tenant');
            Artisan::output();
            $this->info('seeding completed for '.$tenant->name.' tenants ^_^');
        }

    }

    public function allTenants()
    {
        $tenants = Tenant::get();
        // dd($tenants);
        foreach ($tenants as $tenant) {
            $this->info('start migration for tenant : ' . $tenant->name);
            TenantFacade::switchTenant($tenant);
            Artisan::call('migrate:fresh --path=database/migrations/tenants --database=tenant');
            Artisan::call('passport:install');
            $this->info('-------------------');
        }
        $this->info(Artisan::output());
        $this->info('migration completed for all tenants ^_^');
       $seeding=$this->ask('do you want to run seeder ?');
       if($seeding=='yes'){
            return $this->seeder();
       }

        return Command::SUCCESS;
    }
    public function handle()
    {
        $answer = $this->ask('do you mant to migrate all tenants or single tenant ? yes/no');
        if ($answer == 'yes') {
            return $this->allTenants();
        } else {
            $tenantId = $this->ask('please enter a tenant id ...');

            $tenant = Tenant::find($tenantId);
            if (!$tenant) {
                $this->error(' tenant not found');
            }

            TenantService::switchTenant($tenant);
            Artisan::call('migrate:fresh --path=database/migrations/tenants --database=tenant');
            $this->info('-------------------');
            $this->info(Artisan::output());
            $this->info('migration completed for all tenants ^_^');
            return Command::SUCCESS;
        }

        // dd($this->option());
        // return Command::SUCCESS;
    }
}
