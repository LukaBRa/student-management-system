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
            ['class_name' => 'V-1'],
            ['class_name' => 'V-2'],
            ['class_name' => 'V-3'],
            ['class_name' => 'VI-1'],
            ['class_name' => 'VI-2'],
            ['class_name' => 'VI-3'],
            ['class_name' => 'VII-1'],
            ['class_name' => 'VII-2'],
            ['class_name' => 'VII-3'],
            ['class_name' => 'VIII-1'],
            ['class_name' => 'VIII-2'],
            ['class_name' => 'VIII-3'],
        ];

        DB::table('school_classes')->insert($data);
    }
}
