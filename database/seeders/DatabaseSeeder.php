<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Driver;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Erickson Suero',
            'email' => 'ericksuero@gmail.com',
            'password' => bcrypt('superadminpassword'),
            'is_admin' => true
        ]);
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('adminpassword'),
            'is_admin' => true
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('userpassword'),
            'is_admin' => false
        ]);

        Driver::create([
            'name' => 'No Asignado',
        ]);

        Setting::create([
            'name' => 'Transporte Turístico y Empresarial Edwin',
            'rnc' => '131285742',
            'address' => 'Calle 6ta con Calle B, Mi Hogar, Santo Domingo Este 11510',
            'phone' => '(809) 422-3340',
            'mobile' => '(829) 886-6699',
            'email' => 'transporteturisticoedwin@gmail.com',
            'site' => 'https://transporteturisticoedwin.com/',
            'facebook' => 'https://www.facebook.com/Transporte-Tur%C3%ADstico-Edwin-SRL-927196780676784',
            'instagram' => 'https://www.instagram.com/transporteturisticoedwin/',
        ]);
    }
}
