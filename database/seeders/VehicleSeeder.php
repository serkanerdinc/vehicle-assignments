<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Örnek Kullanıcılar
        Vehicle::insert([
            [
                "plate_number" => "35BOR001",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engine_number" => "123456790"
            ],
            [
                "plate_number" => "35BOR002",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engine_number" => "123456791"
            ],
            [
                "plate_number" => "35BOR003",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engine_number" => "123456792"
            ],
            [
                "plate_number" => "35BOR004",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engine_number" => "123456793"
            ],
            [
                "plate_number" => "35BOR005",
                "model" => "Elysee",
                "trademark" => "Citroen",
                "engine_number" => "123456794"
            ],
        ]);
    }
}
