<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'key' => 'token',
            'value' => 'MDEwMDE.eyJiIjo3LCJnIjoxNjcyMTY3MzYzLCJyIjoiU0RTcDZFIiwidCI6MiwibSI6NDE0NDA2MDIyMCwibCI6MTY3MjE2NzM2M30.c9dcd94b3b60513b.69ac87d046cae92371752c755544fbde6e48fb338873b406807103aed54e46a1'
        ]);
        DB::table('configs')->insert([
            'key' => 'smdeviceid',
            'value' => '20221223152913326e082fe455730846a9e4f315f8897a000b51b8f3b3a238'
        ]);
        DB::table('configs')->insert([
            'key' => 'shein_uid',
            'value' => '4126990885'
        ]);
        DB::table('configs')->insert([
            'key' => 'x-gw-auth',
            'value' => 'a=vhOvoNStVeIKfdWT0Gp55rGPHqjicT@8.6.4&b=1671815988939&d=-884979813&e=rfVOeZTgwNjc2OTc4MTkxYjk5ZGVhZWNlZDZhZTQ5MThhZWQ4YzVjMmUzNGIzOTE2Yzg5Y2Y5MWI2Y2I3ZWIyNjI4Mg%3D%3D'
        ]);
    }
}
