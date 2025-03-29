<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);
        DB::table('permissions')->insert([
            'user_id' => '2',
            'role_id' => '2',
        ]);


    }
}
