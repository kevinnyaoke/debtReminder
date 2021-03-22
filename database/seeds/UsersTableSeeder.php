<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();

        App\User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('password'),
            'phone'=>'0797909406',
            'status'=>'active'
        ]);
    }
}
