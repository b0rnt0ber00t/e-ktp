<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = json_decode(file_get_contents(storage_path('json/provinces.json')), true);
        foreach ($provinces as $province) {
            Province::create(['name' => $province['name']]);
        }
    }
}
