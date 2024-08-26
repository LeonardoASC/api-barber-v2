<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Database\Seeders\CategoriaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminUserSeeder::class);
        $this->call(DiaSeeder::class);
        $this->call(HorarioSeeder::class);
        $this->call(HorarioPersonalizadoSeeder::class);
        $this->call(ServicoSeeder::class);
        $this->call(SubServicoSeeder::class);
    }
}
