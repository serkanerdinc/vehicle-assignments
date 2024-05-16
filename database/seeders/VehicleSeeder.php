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
        DB::table('vehicles')->insert([
            [
                "plateNumber" => "35BOR001",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engineNumber" => "123456790"
            ],
            [
                "plateNumber" => "35BOR002",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engineNumber" => "123456791"
            ],
            [
                "plateNumber" => "35BOR003",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engineNumber" => "123456792"
            ],
            [
                "plateNumber" => "35BOR004",
                "model" => "Egea",
                "trademark" => "Fiat",
                "engineNumber" => "123456793"
            ],
            [
                "plateNumber" => "35BOR005",
                "model" => "Elysee",
                "trademark" => "Citroen",
                "engineNumber" => "123456794"
            ],
        ]);
    }
}
