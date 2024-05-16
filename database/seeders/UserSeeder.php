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
        // Başlangıç kullanıcısı
        User::create([
            'name' => 'Serkan Erdinç',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => "admin"
        ]);
    }
}
