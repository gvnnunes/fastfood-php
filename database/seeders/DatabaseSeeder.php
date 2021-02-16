<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

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

        Product::create([
            'name'      => 'Produto 1',
            'value'     => '18.50',
            'photo'     => 'images/hamburguer.jpg'
        ]);

        Product::create([
            'name'      => 'Produto 2',
            'value'     => '12.99',
            'photo'     => 'images/hamburguer.jpg'
        ]);

        Product::create([
            'name'      => 'Produto 3',
            'value'     => '25.00',
            'photo'     => 'images/hamburguer.jpg'
        ]);

        Product::create([
            'name'      => 'Produto 4',
            'value'     => '7.25',
            'photo'     => 'images/hamburguer.jpg'
        ]);

        Product::create([
            'name'      => 'Produto 5',
            'value'     => '9.00',
            'photo'     => 'images/hamburguer.jpg'
        ]);
    }
}
