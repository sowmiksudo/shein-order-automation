<?php

use App\Models\Config;
use Illuminate\Support\Facades\Log;

function get_settings($key){
    return Config::where('key', $key)->get()->first()->value ?? null;
}

function get_token(){
    return get_settings('token');
}

function log_res($log, $from = ""){
    Log::channel('shein')->info($log . "|| $from ||");
}
