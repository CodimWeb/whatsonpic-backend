<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = Storage::get('property-data.csv');
        $lines = explode(PHP_EOL, $csvData);
        $homes = [];

        foreach ($lines as $line) {
            $homes[] = str_getcsv($line);
        }

        unset($homes[0]);

        foreach ($homes as $home) {
            Home::updateOrCreate([
                'name' => $home[0],
                'price' => $home[1],
                'bedrooms' => $home[2],
                'bathrooms' => $home[3],
                'storeys' => $home[4],
                'garages' => $home[5],
            ]);
        }
    }
}
