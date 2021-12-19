<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $villages = json_decode(file_get_contents(storage_path('json/villages.json')), true);
        foreach ($villages as $village) {
            Village::create([
                'kode'           => $village['kode'],
                'district_kode' => $village['district_kode'],
                'name'           => $village['name'],
            ]);
        }
    }
}
