<?php

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regencies = json_decode(file_get_contents(storage_path('json/regencies.json')), true);
        foreach ($regencies as $regency) {
            Regency::create([
                'province_id' => $regency['province_id'],
                'zip'         => $regency['zip'],
                'name'        => $regency['name'],
            ]);
        }
    }
}
