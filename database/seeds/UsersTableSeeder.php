<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Alfredo Andres',
            'email' => 'demo@demo.com.ar',
            'password' => bcrypt('12345'),
            'dni' => '27493492',
            'matricula' => '',
            'direccion' => '',
            'telefono' => '',
            'role' => 'admin'
        ]);
        factory(User::class, 50)->create();
    }
}
