<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['subject_code' => '1442', 'subject_name' => 'Matematika'],
            ['subject_code' => '2312', 'subject_name' => 'Fizika'],
            ['subject_code' => '5321', 'subject_name' => 'Hemija'],
            ['subject_code' => '5355', 'subject_name' => 'Informatika'],
            ['subject_code' => '2122', 'subject_name' => 'Srpski jezik'],
            ['subject_code' => '3123', 'subject_name' => 'Francuski jezik'],
            ['subject_code' => '3333', 'subject_name' => 'Engleski jezik'],
            ['subject_code' => '5412', 'subject_name' => 'Geografija'],
            ['subject_code' => '6621', 'subject_name' => 'Istorija'],
            ['subject_code' => '4765', 'subject_name' => 'Biologija'],
            ['subject_code' => '5743', 'subject_name' => 'Fizičko'],
            ['subject_code' => '1766', 'subject_name' => 'Likovno'],
        ];

        DB::table('subjects')->insert($data);
    }
}
