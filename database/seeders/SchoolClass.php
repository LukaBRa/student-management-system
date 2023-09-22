<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolClass extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['class_name' => 'I-a'],
            ['class_name' => 'I-b'],
            ['class_name' => 'I-v'],
            ['class_name' => 'I-g'],
            ['class_name' => 'II-a'],
            ['class_name' => 'II-b'],
            ['class_name' => 'II-v'],
            ['class_name' => 'II-g'],
            ['class_name' => 'III-a'],
            ['class_name' => 'III-b'],
            ['class_name' => 'III-v'],
            ['class_name' => 'III-g'],
            ['class_name' => 'IV-a'],
            ['class_name' => 'IV-b'],
            ['class_name' => 'IV-v'],
            ['class_name' => 'IV-g'],
        ];

        DB::table('school_classes')->insert($data);
    }
}
