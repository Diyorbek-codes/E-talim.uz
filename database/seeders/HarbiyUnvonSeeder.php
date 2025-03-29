<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class HarbiyUnvonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("harbiy_unvons")->insert([
            'nomi'=>'leytenant',
            'qs_nomi'=>'l-nt'
        ]);
        DB::table("harbiy_unvons")->insert([
            'nomi'=>'katta leytenant',
            'qs_nomi'=>'k/l-nt'
        ]);

        DB::table("harbiy_unvons")->insert([
            'nomi'=>'kapitan',
            'qs_nomi'=>'k-n'
        ]);

        DB::table("harbiy_unvons")->insert([
            'nomi'=>'mayor',
            'qs_nomi'=>'m-r'
        ]);

        DB::table("harbiy_unvons")->insert([
            'nomi'=>'podpolkovnik',
            'qs_nomi'=>'p/p-k'
        ]);

        DB::table("harbiy_unvons")->insert([
            'nomi'=>'polkovnik',
            'qs_nomi'=>'p-k'
        ]);

        DB::table("harbiy_unvons")->insert([
            'nomi'=>'Qurolli kuchlar xizmatchisi',
            'qs_nomi'=>'QKX'
        ]);

        DB::table("harbiy_unvons")->insert([
            'nomi'=>'kursant',
            'qs_nomi'=>'k-nt'
        ]);
    }
}
