<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert(
            [
                'name' => 'Paco',
                'last_name' => 'Barriga Dura',
                'phone' => '+34 789654234',
                'email' => 'pacoelduro@gmailcom',
                'password' => '123456',
            ],
            [
                'name' => 'Salva',
                'last_name' => 'Patas Gordas',
                'phone' => '+34 789654234',
                'email' => 'salvaelpata@gmailcom',
                'password' => '123456',
            ]
        );
    }
}
