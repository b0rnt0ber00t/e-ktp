<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = json_decode(file_get_contents(storage_path('json/districts.json')), true);
        foreach ($districts as $district) {
            District::create([
                'kode'         => $district['kode'],
                'regencie_zip' => $district['regencie_zip'],
                'name'         => $district['name'],
            ]);
        }
    }
}
