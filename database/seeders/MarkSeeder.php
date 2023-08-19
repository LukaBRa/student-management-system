<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => '2',
                'subject_id' => '1',
                'mark' => '4'
            ],
            [
                'user_id' => '2',
                'subject_id' => '1',
                'mark' => '3'
            ],
            [
                'user_id' => '2',
                'subject_id' => '1',
                'mark' => '3'
            ],
            [
                'user_id' => '2',
                'subject_id' => '1',
                'mark' => '1'
            ],
        ];

        DB::table('marks')->insert($data);
    }
}
