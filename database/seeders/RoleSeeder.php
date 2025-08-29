<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'alumno',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}