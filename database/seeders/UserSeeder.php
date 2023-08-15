<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'type_id' => '1',
                'class_id' => null,
                'name' => "Petar Petrovic",
                'email' => 'pera@gmail.com',
                'password' => Hash::make("pera2000"),
                'adress' => "Beograd 11",
                'phone_number' => "1236342112"
            ],
        ];

        DB::table('users')->insert($data);
    }
}
