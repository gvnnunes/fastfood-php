<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'username'      => 'cozinha',
            'password'      => bcrypt('123456'),
            'permission'    => 'app.kitchen'
        ]);

        User::create([
            'username'      => 'retirada',
            'password'      => bcrypt('123456'),
            'permission'    => 'app.withdraw'
        ]);

        User::create([
            'username'      => 'gerente',
            'password'      => bcrypt('123456'),
            'permission'    => 'app.manager'
        ]);

        User::create([
            'username'      => 'cliente',
            'password'      => bcrypt('123456'),
            'permission'    => 'app.user'
        ]);
    }
}
