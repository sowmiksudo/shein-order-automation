<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            [
                'contact' => 'xowmik@gmail.com',
                'type' => 'email'
            ],
            [
                'contact' => '+8801955033900',
                'type' => 'phone'
            ]
        ]);
    }
}
