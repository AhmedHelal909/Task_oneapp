<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
              'name'=> 'Ahmed',
              'email'=>'am9514994@gmail.com',
              'password'=> bcrypt('123456')
        ]);
    }
}