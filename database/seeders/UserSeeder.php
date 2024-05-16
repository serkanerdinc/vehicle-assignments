<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Örnek Kullanıcılar
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => "admin"
        ]);
        User::insert([
            [
                "name" => "Deniz Gümüş",
                "email" => "deniz@gumus.com",
                "department" => "Yazılım",
                "title" => "Yazılım Uzmanı",
                "phone" => "05546161311",
                'role' => "user"
            ],
            [
                "name" => "Ahmet Mete",
                "email" => "ahmet@mete.com",
                "department" => "Yazılım",
                "title" => "Yazılım Uzmanı",
                "phone" => "05541234567",
                'role' => "user"
            ],
            [
                "name" => "Merve Egeli",
                "email" => "merve@egeli.com",
                "department" => "IK",
                "title" => "İnsan Kaynakları Uzmanı",
                "phone" => "05547654321",
                'role' => "user"
            ]
        ]);
    }
}
