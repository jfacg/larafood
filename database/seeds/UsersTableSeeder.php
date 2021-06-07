<?php

use App\Models\Tenant;
use App\User;
// use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first(); 

        $tenant->users()->create([
            'name' => 'Jailson Ferreira',
            'email' => 'jailson.pb@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
