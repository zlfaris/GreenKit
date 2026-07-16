<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function calculateShipping(Request $request)
    {
        $request->validate([
            'destination' => 'required|integer',
        ]);

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])
        ->asForm()
        ->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'origin' => 254,
            'destination' => (int) $request->destination,
            'weight' => 1000,
            'courier' => 'jnt',
            'price' => 'lowest',
        ]);

        return $response->json();
    }
}
