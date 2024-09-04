<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Supplier;
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
        User::create([
            'name'      => 'tes',
            'jabatan'   => 'tes',
            'email'     => 'tes@gmail.com',
            'role'      => 'admin',
            'password'  => bcrypt('password'),
        ]);

        User::create([
            'name'      => 'Sanjay Singh',
            'jabatan'   => 'Super Admin',
            'email'     => 'admin@gmail.com',
            'role'      => 'superadmin',
            'password'  => bcrypt('password'),
        ]);
    }
}
