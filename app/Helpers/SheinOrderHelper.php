<?php

use App\Models\Config;
use App\Models\Contact;
use App\Utility\SheinOrderUtility;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

function get_settings($key){
    return Config::where('key', $key)->get()->first()->value ?? null;
}

function get_token(){
    return get_settings('token');
}

function log_res($log, $from = ""){
    // dump(json_decode($log));
    dump($from);
    Log::channel('shein')->info($log . "|| $from ||");
}

function send_alert(Throwable $e){
    $numbers = Contact::where('type', 'phone')->get();
    $emails = Contact::where('type', 'email')->get();

    // foreach ($numbers as $key => $value) {
    //     $number = $value->contact;
    // }

}

function shein_url($pid, $cid){
    return "https://my.shein.com/x-p-$pid-cat-$cid.html";
}

function send_update($order){
    $client = new SheinOrderUtility;
    return $client->send_update($order);
}
