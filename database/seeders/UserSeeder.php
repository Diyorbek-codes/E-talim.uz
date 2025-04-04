<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'nomi' => 'MV ADMIN',
            'login' => 'mv_admin',
            'password' => bcrypt('12345678'),
        ]);
        DB::table('users')->insert([
            'nomi' => 'MV_UPVKA',
            'login' => 'mv_upvka',
            'password' => bcrypt('12345678'),
        ]);



    }
}
