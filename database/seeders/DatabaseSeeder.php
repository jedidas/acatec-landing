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
            'password' => Hash::make('@T#E$>9;V5:9<7*4'),
            'email' => 'jedidas@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'manager',
            'password' => Hash::make('hD]<k84;30-nq@H4y'),
            'email' => 'base@website.com',
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,
        ]);
    }
}
