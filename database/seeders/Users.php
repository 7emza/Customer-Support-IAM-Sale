<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // //craete roles
        (Role::where('name', 'sys-admin')->first()) ?: Role::create(['name' => 'sys-admin']);
        (Role::where('name', 'admin')->first()) ?: Role::create(['name' => 'admin']);
        (Role::where('name', 'customer')->first()) ?: Role::create(['name' => 'customer']);

        // //create permissions
        (Permission::where('name', 'create')->first()) ?: Permission::create(['name' => 'create']);
        (Permission::where('name', 'display')->first()) ?: Permission::create(['name' => 'display']);
        (Permission::where('name', 'show')->first()) ?: Permission::create(['name' => 'show']);
        (Permission::where('name', 'edit')->first()) ?: Permission::create(['name' => 'edit']);
        (Permission::where('name', 'change status')->first()) ?: Permission::create(['name' => 'change status']);


        // (User::where('email', "hamza.driouch@uit.ac.ma")->first()) ?: User::create([
        //     'name' => 'System Admin',
        //     'email'    => 'hamza.driouch@uit.ac.ma',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ]);

        (User::where('email', "admin@estsale")->first()) ?: User::create([
            'name' => 'customer support',
            'email'    => 'admin@estsale',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        
        (User::where('email', "customer@estsale")->first()) ?: User::create([
            'name' => 'customer x',
            'email'    => 'customer@estsale',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        //customer 2
        (User::where('email', "customer2@estsale")->first()) ?: User::create([
            'name' => 'customer x',
            'email'    => 'customer2@estsale',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        //assing roles
        // User::where('email', '=', 'admin@estsale')->first()->assignRole('sys-admin');

        User::where('email', 'admin@estsale')->first()->assignRole('admin');
        User::where('email', 'customer@estsale')->first()->assignRole('customer');

        // User::where('email', 'hamza.driouch@uit.ac.ma')->first()->assignRole('sys-admin');
    }
}
