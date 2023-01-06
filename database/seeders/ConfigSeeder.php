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
            'value' => 'MDEwMDE.eyJiIjo3LCJnIjoxNjcyMjk5NDQ2LCJyIjoiMDJVVk9SIiwidCI6MiwibSI6MTEwMzIwNzA2NywibCI6MTY3MjMyMzQxNX0.78fae653b8717eb1.7f4e4b711b7fa90a806a7e1d937664202db9ba05d251dac6f8f4c09c116c6a51'
        ]);
        DB::table('configs')->insert([
            'key' => 'smdeviceid',
            'value' => '20221223152913326e082fe455730846a9e4f315f8897a000b51b8f3b3a238'
        ]);
        DB::table('configs')->insert([
            'key' => 'shein_uid',
            'value' => '1103207067'
        ]);
        DB::table('configs')->insert([
            'key' => 'x-gw-auth',
            'value' => 'a=vhOvoNStVeIKfdWT0Gp55rGPHqjicT@8.6.4&b=1671815988939&d=-884979813&e=rfVOeZTgwNjc2OTc4MTkxYjk5ZGVhZWNlZDZhZTQ5MThhZWQ4YzVjMmUzNGIzOTE2Yzg5Y2Y5MWI2Y2I3ZWIyNjI4Mg%3D%3D'
        ]);
        DB::table('configs')->insert([
            'key' => 'address_id',
            'value' => '426631032'
        ]);
    }
}
