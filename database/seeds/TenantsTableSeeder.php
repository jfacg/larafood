<?php

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '11035843000140',
            'name' => 'Linknet',
            'url' => 'linknet',
            'email' => 'linknet@linknetcg.com.br'
        ]);
    }
}
