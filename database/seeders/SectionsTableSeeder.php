<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionRecords = [
            ['id'=>1, 'name'=>'پوشاک', 'status'=>1],
            ['id'=>2, 'name'=>'موبایل', 'status'=>1],
            ['id'=>3, 'name'=>'مواد غذایی', 'status'=>1],
        ];

        Section::insert($sectionRecords);
    }
}
