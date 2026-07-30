<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jedidas',
            'password' => Hash::make("r\+Mto(iU~5>;s0'*3"),
            'email' => 'jedidas@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'manager',
            'password' => Hash::make('>5ZH2?2;T}8?(4u<£1'),
            'email' => 'info@acatecso.com',
        ]);

        $this->call([
            SettingSeeder::class,
            PageSeeder::class,
        ]);
    }
}
