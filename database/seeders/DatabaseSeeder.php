<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\SlotParkir\Models\ParkingSlot;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@parktrack.com'],
            [
                'name' => 'Admin Petugas',
                'phone' => '081234567890',
                'role' => UserRole::Officer,
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Utama',
                'phone' => '089876543210',
                'role' => UserRole::User,
                'password' => Hash::make('password123'),
            ]
        );

        if (User::count() < 7) {
            $faker = Faker::create('id_ID');
            for ($i = 1; $i <= 5; $i++) {
                User::create([
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'phone' => '08'.$faker->numerify('##########'),
                    'role' => UserRole::User,
                    'password' => Hash::make('password123'),
                ]);
            }
        }

        if (ParkingSlot::count() === 0) {
            $blocks = ['A', 'B', 'C'];
            foreach ($blocks as $block) {
                for ($i = 1; $i <= 5; $i++) {
                    ParkingSlot::create([
                        'kode_slot' => $block.'-0'.$i,
                        'lantai' => 'Lantai '.($block === 'C' ? '2' : '1'),
                        'tipe_kendaraan' => $block === 'B' ? 'Motor' : 'Mobil',
                        'tarif_per_jam' => $block === 'B' ? 2000 : 4000,
                        'status' => 'Tersedia',
                    ]);
                }
            }
        }
    }
}
