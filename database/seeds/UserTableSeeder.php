<?php

use Illuminate\Database\Seeder;
use Faker\Provider\Uuid;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      	DB::table('users')->insert([
            'user_guid' => Uuid::uuid(),
            'firstname' => 'Axel',
            'middlename' => 'Cudal',
            'lastname' => 'lastname',
            'username' => 'rozxel21',
            'email' => 'roz.axel0721@gmail.com',
            'password' => bcrypt('saitama'),
            'credential' => 'administrator',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
