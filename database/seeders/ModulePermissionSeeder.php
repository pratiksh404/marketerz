<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class ModulePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('make:permission Contact --all');
        Artisan::call('make:permission Group --all');
        Artisan::call('make:permission Client --all');
        Artisan::call('make:permission Source --all');
        Artisan::call('make:permission Service --all');
        Artisan::call('make:permission Template --all');
        Artisan::call('make:permission Campaign --all');
        Artisan::call('make:permission Task --all');
        Artisan::call('make:permission Department --all');
        Artisan::call('make:permission Package --all');
        Artisan::call('make:permission Lead --all');
        Artisan::call('make:permission Discussion --all');
        Artisan::call('make:permission Project --all');
        Artisan::call('make:permission Payment --all');
        Artisan::call('make:permission Advance --all');
        Artisan::call('make:permission Expense --all');
    }
}
