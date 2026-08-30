<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Airplane;
use App\Models\Airport;
use App\Models\FlightRoute;
use App\Models\FlightSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Seeds realistic demo data so the public site and admin panel have
 * something to show right away. Runs automatically as part of
 * `php artisan db:seed` (called from DatabaseSeeder) — no --class flag needed.
 */
class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $airports = collect([
            ['name' => 'Hazrat Shahjalal International Airport', 'code' => 'DAC', 'city' => 'Dhaka', 'country' => 'Bangladesh'],
            ['name' => "Shah Amanat International Airport", 'code' => 'CGP', 'city' => 'Chattogram', 'country' => 'Bangladesh'],
            ['name' => 'Osmani International Airport', 'code' => 'ZYL', 'city' => 'Sylhet', 'country' => 'Bangladesh'],
            ['name' => 'Cox\'s Bazar Airport', 'code' => 'CXB', 'city' => "Cox's Bazar", 'country' => 'Bangladesh'],
            ['name' => 'Indira Gandhi International Airport', 'code' => 'DEL', 'city' => 'Delhi', 'country' => 'India'],
            ['name' => 'Singapore Changi Airport', 'code' => 'SIN', 'city' => 'Singapore', 'country' => 'Singapore'],
            ['name' => 'Dubai International Airport', 'code' => 'DXB', 'city' => 'Dubai', 'country' => 'UAE'],
            ['name' => 'Suvarnabhumi Airport', 'code' => 'BKK', 'city' => 'Bangkok', 'country' => 'Thailand'],
        ])->map(fn($a) => Airport::firstOrCreate(['code' => $a['code']], $a + ['status' => 'active']));

        $airlines = collect([
            ['name' => 'Biman Bangladesh Airlines', 'code' => 'BG', 'country' => 'Bangladesh'],
            ['name' => 'US-Bangla Airlines', 'code' => 'BS', 'country' => 'Bangladesh'],
            ['name' => 'Novoair', 'code' => 'VQ', 'country' => 'Bangladesh'],
        ])->map(fn($a) => Airline::firstOrCreate(['code' => $a['code']], $a + ['status' => 'active']));

        // Real aircraft photos already bundled under public/frontend-assets/images
        // are copied onto the airplane records so the admin panel & seat map
        // show an actual photo instead of a blank placeholder.
        $imageSource = public_path('frontend-assets/images');
        $imageMap = [
            'S2-AJU' => 'Lufthansa 747.webp', // Boeing 787-8 Dreamliner (widebody)
            'S2-AGQ' => 'boeing-us.webp',     // Boeing 737-800
            'S2-AGX' => 'us-bangla-1.jpg',    // ATR 72-600 (regional)
        ];

        $airplanes = collect([
            ['name' => 'Boeing 787-8 Dreamliner', 'model' => '787-8', 'code' => 'S2-AJU', 'seat_rows' => 25, 'seat_columns' => 6],
            ['name' => 'Boeing 737-800', 'model' => '737-800', 'code' => 'S2-AGQ', 'seat_rows' => 20, 'seat_columns' => 6],
            ['name' => 'ATR 72-600', 'model' => 'ATR 72-600', 'code' => 'S2-AGX', 'seat_rows' => 12, 'seat_columns' => 4],
        ])->map(function ($a) use ($imageSource, $imageMap) {
            $a['total_seats'] = $a['seat_rows'] * $a['seat_columns'];
            $a['status'] = 'active';

            $existing = Airplane::where('code', $a['code'])->first();
            if ($existing) {
                return $existing;
            }

            $sourceFile = $imageSource . '/' . ($imageMap[$a['code']] ?? '');
            if (isset($imageMap[$a['code']]) && File::exists($sourceFile)) {
                Storage::disk('public')->makeDirectory('airplanes');
                $destName = 'airplanes/' . $a['code'] . '-' . $imageMap[$a['code']];
                Storage::disk('public')->put($destName, File::get($sourceFile));
                $a['image'] = $destName;
            }

            return Airplane::create($a);
        });

        $dac = $airports->firstWhere('code', 'DAC');
        $cgp = $airports->firstWhere('code', 'CGP');
        $zyl = $airports->firstWhere('code', 'ZYL');
        $cxb = $airports->firstWhere('code', 'CXB');
        $del = $airports->firstWhere('code', 'DEL');
        $sin = $airports->firstWhere('code', 'SIN');
        $dxb = $airports->firstWhere('code', 'DXB');
        $bkk = $airports->firstWhere('code', 'BKK');

        $bg = $airlines->firstWhere('code', 'BG');
        $bs = $airlines->firstWhere('code', 'BS');
        $vq = $airlines->firstWhere('code', 'VQ');

        $dreamliner = $airplanes->firstWhere('code', 'S2-AJU');
        $b738 = $airplanes->firstWhere('code', 'S2-AGQ');
        $atr = $airplanes->firstWhere('code', 'S2-AGX');

        $routeDefs = [
            ['airline' => $bg, 'from' => $dac, 'to' => $cxb, 'distance' => 400, 'duration' => 60, 'plane' => $atr, 'price' => 4500, 'flight' => 'BG-147'],
            ['airline' => $bg, 'from' => $cxb, 'to' => $dac, 'distance' => 400, 'duration' => 60, 'plane' => $atr, 'price' => 4500, 'flight' => 'BG-148'],

            ['airline' => $bs, 'from' => $dac, 'to' => $cgp, 'distance' => 210, 'duration' => 45, 'plane' => $atr, 'price' => 3200, 'flight' => 'BS-201'],
            ['airline' => $bs, 'from' => $cgp, 'to' => $dac, 'distance' => 210, 'duration' => 45, 'plane' => $atr, 'price' => 3200, 'flight' => 'BS-202'],

            ['airline' => $vq, 'from' => $dac, 'to' => $zyl, 'distance' => 190, 'duration' => 40, 'plane' => $atr, 'price' => 3000, 'flight' => 'VQ-311'],
            ['airline' => $vq, 'from' => $zyl, 'to' => $dac, 'distance' => 190, 'duration' => 40, 'plane' => $atr, 'price' => 3000, 'flight' => 'VQ-312'],

            ['airline' => $bg, 'from' => $dac, 'to' => $del, 'distance' => 1500, 'duration' => 130, 'plane' => $b738, 'price' => 18500, 'flight' => 'BG-025'],
            ['airline' => $bg, 'from' => $del, 'to' => $dac, 'distance' => 1500, 'duration' => 130, 'plane' => $b738, 'price' => 18500, 'flight' => 'BG-026'],

            ['airline' => $bg, 'from' => $dac, 'to' => $sin, 'distance' => 2900, 'duration' => 240, 'plane' => $dreamliner, 'price' => 32000, 'flight' => 'BG-089'],
            ['airline' => $bg, 'from' => $sin, 'to' => $dac, 'distance' => 2900, 'duration' => 240, 'plane' => $dreamliner, 'price' => 32000, 'flight' => 'BG-090'],

            ['airline' => $bs, 'from' => $dac, 'to' => $dxb, 'distance' => 3800, 'duration' => 290, 'plane' => $dreamliner, 'price' => 41000, 'flight' => 'BS-501'],
            ['airline' => $bs, 'from' => $dxb, 'to' => $dac, 'distance' => 3800, 'duration' => 290, 'plane' => $dreamliner, 'price' => 41000, 'flight' => 'BS-502'],

            ['airline' => $bg, 'from' => $dac, 'to' => $bkk, 'distance' => 2200, 'duration' => 180, 'plane' => $b738, 'price' => 26500, 'flight' => 'BG-088'],
            ['airline' => $bg, 'from' => $bkk, 'to' => $dac, 'distance' => 2200, 'duration' => 180, 'plane' => $b738, 'price' => 26500, 'flight' => 'BG-087'],
        ];

        foreach ($routeDefs as $def) {
            $route = FlightRoute::firstOrCreate([
                'airline_id' => $def['airline']->id,
                'origin_airport_id' => $def['from']->id,
                'destination_airport_id' => $def['to']->id,
            ], [
                'distance_km' => $def['distance'],
                'duration_minutes' => $def['duration'],
                'status' => 'active',
            ]);

            FlightSchedule::firstOrCreate([
                'route_id' => $route->id,
                'flight_number' => $def['flight'],
            ], [
                'airplane_id' => $def['plane']->id,
                'departure_time' => '09:30',
                'arrival_time' => \Carbon\Carbon::createFromFormat('H:i', '09:30')->addMinutes($def['duration'])->format('H:i'),
                'days_of_operation' => 'Daily',
                'price' => $def['price'],
                'status' => 'scheduled',
            ]);
        }
    }
}
