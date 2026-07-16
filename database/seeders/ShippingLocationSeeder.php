<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\City;

class ShippingLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKey = '8veh1THc0a30f9d74d45eebeeBzN2ZCy';
        $headers = [
            'accept' => 'application/json',
            'key' => $apiKey
        ];

        // Step 1: Seed Provinces
        $provinceResponse = Http::withoutVerifying()
            ->timeout(120)
            ->withHeaders($headers)
            ->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        if ($provinceResponse->successful()) {
            $provinces = $provinceResponse->json('data') ?? [];
            foreach ($provinces as $provinceData) {
                Province::updateOrCreate(
                    ['province_id' => $provinceData['id']],
                    ['name' => $provinceData['name']]
                );
            }
        }

        // Step 2: Seed Cities (Dynamic Loop)
        $provinces = Province::all();
        foreach ($provinces as $province) {
            $cityResponse = Http::withoutVerifying()
                ->timeout(120)
                ->withHeaders($headers)
                ->get('https://rajaongkir.komerce.id/api/v1/destination/city/' . $province->province_id);

            if ($cityResponse->successful()) {
                $cities = $cityResponse->json('data') ?? [];
                foreach ($cities as $cityData) {
                    City::updateOrCreate(
                        ['city_id' => $cityData['id']],
                        [
                            'province_id' => $province->province_id,
                            'type' => $cityData['type'] ?? '',
                            'name' => $cityData['name'] ?? '',
                            'postal_code' => $cityData['postal_code'] ?? '',
                        ]
                    );
                }
            }
        }

        $this->command->info('Provinces and Cities seeded successfully!');
    }
}
