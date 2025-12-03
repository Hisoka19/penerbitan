<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat role default
        $roleId = \Illuminate\Support\Str::uuid();
        \DB::table('roles')->insert([
            'id' => $roleId,
            'nama_role' => 'admin',
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $roleId,
        ]);
    }
}
