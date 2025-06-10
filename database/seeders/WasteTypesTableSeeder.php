<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WasteType;

class WasteTypesTableSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['name' => 'Leftover Food'],
            ['name' => 'Rice'],
            ['name' => 'Fruits'],
            ['name' => 'Vegetables'],
            ['name' => 'Miscellaneous'],


        ];

        foreach ($types as $type) {
            WasteType::create($type);
        }
    }
}