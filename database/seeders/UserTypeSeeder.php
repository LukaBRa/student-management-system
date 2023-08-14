<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['user_type' => 'administrator'],
            ['user_type' => 'profesor'],
            ['user_type' => 'roditelj'],
            ['user_type' => 'ucenik'],
        ];

        DB::table('user_types')->insert($data);
    }
}
