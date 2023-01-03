<?php

namespace App\Utility;

use GuzzleHttp;
use GuzzleHttp\Psr7\Request;


class SheinOrderUtility
{
    public $client;

    public function __construct()
    {
        $this->client = new GuzzleHttp\Client([
            'proxy' => env('APP_PROXY'),
        ]);
    }

    public function ip_info()
    {
        $request = new Request('GET', 'http://ip-api.com/json');
        return $this->client->sendAsync($request)->wait()->getBody()->getContents();
    }

    public function login($email, $password)
    {
        $client = $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'applanguage' => 'en',
            'usercountry' => 'BD',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'BD',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'appversion' => '8.7.6',
            'language' => 'en',
            'currency' => 'USD',
            'network-type' => 'WIFI',
            'token' => 'MDEwMDE.eyJiIjo3LCJnIjoxNjcxNzg2OTY5LCJyIjoiY0txbjNHIiwidCI6MX0.0e29883797f92028',
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'USD',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en',
            'content-type' => 'application/x-www-form-urlencoded',
            'accept-encoding' => 'gzip'
        ];
        $options = [
            'form_params' => [
                'risk_id' => '',
                'password' => '21#]nMHF',
                'clause_country_id' => '0',
                'clause_agree' => '',
                'challenge' => '2edbc3d8dd5723579a8c983503e34dbb',
                'clause_flag' => '',
                'email' => 'xowmik@gmail.com',
                'validate' => '1'
            ]
        ];
        $request = new Request('POST', 'https://api-service.shein.com/user/common_login', $headers);
        $res = $client->sendAsync($request, $options)->wait();
        return $res->getBody();
    }

    public function addToCart($goods_id, $sku)
    {
        $client = $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'applanguage' => 'en',
            'usercountry' => 'MY',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'sortuid' => get_settings('shein_uid'),
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'appversion' => '8.7.6',
            'newuid' => get_settings('shein_uid'),
            'language' => 'en',
            'currency' => 'MYR',
            'network-type' => 'WIFI',
            'token' => get_token(),
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'content-type' => 'application/x-www-form-urlencoded',
            'content-length' => '119',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $options = [
            'form_params' => [
                'freeShippingAbtParams' => '',
                'mall_code' => '1',
                'quantity' => '1',
                'fromPageName' => 'goodsDetailAddToCart',
                'goods_id' => $goods_id,
                'sku_code' => $sku
            ]
        ];
        $request = new Request('POST', 'https://api-service.shein.com/order/add_to_cart?goods_id=' . $goods_id, $headers);
        $res = $client->sendAsync($request, $options)->wait();
        return $res->getBody();
    }

    public function get_cart()
    {
        $client = $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_ui'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'newuid' => get_settings('shein_ui'),
            'appversion' => '8.7.6',
            'language' => 'en',
            'currency' => 'MYR',
            'token' => get_token(),
            'network-type' => 'WIFI',
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $request = new Request('GET', 'https://api-service.shein.com/order/mall/cart/index?is_first=0&country_id=128', $headers);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }

    public function change_cart_item_status($cart_id, $op_type)
    {
        $client = $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_uid'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'newuid' => get_settings('shein_uid'),
            'appversion' => '8.7.6',
            'language' => 'en',
            'currency' => 'MYR',
            'token' => get_token(),
            'network-type' => 'WIFI',
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'content-type' => 'application/x-www-form-urlencoded',
            'content-length' => '63',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $options = [
            'form_params' => [
                'cart_id_list' => $cart_id,
                'operation_type' => $op_type,
                'country_id' => '128'
            ]
        ];
        $request = new Request('POST', 'https://api-service.shein.com/order/mall/modify_cart_check_status', $headers);
        $res = $client->sendAsync($request, $options)->wait();
        return $res->getBody();
    }

    public function change_cart_item_quantity($cart_id, $quantity)
    {
        $client = $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_uid'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'newuid' => get_settings('shein_uid'),
            'appversion' => '8.7.6',
            'language' => 'en',
            'currency' => 'MYR',
            'token' => get_token(),
            'network-type' => 'WIFI',
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'content-type' => 'application/json; charset=utf-8',
            'content-length' => '103',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];

        $body = json_encode([
            'cart_id' => $cart_id,
            'quantity' => $quantity,
            'append_id_list' => [],
            'id_checked' => 1,
            'country_id' => 128
        ]);

        $request = new Request('POST', 'https://api-service.shein.com/order/mall/cart_update', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }


    public function checkout_cart()
    {
        $client = $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_uid'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'appversion' => '8.7.6',
            'newuid' => get_settings('shein_uid'),
            'language' => 'en',
            'currency' => 'MYR',
            'network-type' => 'WIFI',
            'token' => get_token(),
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'content-type' => 'application/json; charset=utf-8',
            'content-length' => '94',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $body = json_encode([
            'isFirst' => 1,
            'goods_type' => 0,
            'is_old_version' => 0,
            'country_id' => 128,
            'giftcard_verify' => 0
        ]);

        $request = new Request('POST', 'https://api-service.shein.com/order/order/checkout', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }

    public function checkout_cart_2()
    {
        $client = new $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_uid'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'appversion' => '8.7.6',
            'newuid' => get_settings('shein_uid'),
            'language' => 'en',
            'currency' => 'MYR',
            'network-type' => 'WIFI',
            'token' => get_token(),
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'content-type' => 'application/json; charset=utf-8',
            'content-length' => '94',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $body = [
            "address_id" => "761216805",
            "is_old_version" => "0",
            "giftcard_verify" => "0",
            "isCheckClause" => "0",
            "shipping_methods" => [
                [
                    "last_transport_type" => "",
                    "mall_code" => "1",
                    "transport_type" => "standard_express",
                    "use_insurance" => "1"
                ]
            ],
            "payment_id" => "4727",
            "front_country_id" => "128",
            "is_buy_coupon" => "0",
            "goods_type" => "0",
            "payment_code_unique" => "cod",
            "use_wallet" => "0",
            "payment_code" => "cod"
        ];
        $request = new Request('POST', 'https://api-service.shein.com/order/order/checkout', $headers, json_encode($body));
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }

    public function place_order($payment_id)
    {
        $client = $this->client;
        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_uid'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'appversion' => '8.7.6',
            'newuid' => get_settings('shein_uid'),
            'language' => 'en',
            'currency' => 'MYR',
            'network-type' => 'WIFI',
            'token' => get_token(),
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'content-type' => 'application/json; charset=utf-8',
            'content-length' => '357',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $body = json_encode([
            "isCheckClause" => 0,
            "shipping_methods" => [
                [
                    "last_transport_type" => "",
                    "mall_code" => 1,
                    "transport_type" => "standard_express",
                    "use_insurance" => 1
                ]
            ],
            "payment_id" => $payment_id,
            "address_id" => get_settings('address_id'),
            "front_country_id" => 128,
            "is_buy_coupon" => 0,
            "goods_type" => 0,
            "payment_code_unique" => "cod",
            "is_old_version" => 0,
            "use_wallet" => 0,
            "giftcard_verify" => 0,
            "payment_code" => "cod"
        ]);
        $request = new Request('POST', 'https://api-service.shein.com/order/add_order', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }

    public function cod_confirm($billno)
    {
        $client = $this->client;

        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_uid'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'appversion' => '8.7.6',
            'newuid' => get_settings('shein_uid'),
            'language' => 'en',
            'currency' => 'MYR',
            'network-type' => 'WIFI',
            'token' => get_token(),
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $request = new Request('GET', 'https://api-service.shein.com/order/cod/verify/config?billno=' . $billno, $headers);
        $res = $client->sendAsync($request)->wait();
        $config_res = $res->getBody();

        $headers = [
            'Host' => 'api-service.shein.com',
            'app-from' => 'shein',
            'siteuid' => 'android',
            'appcountry' => 'US',
            'branch' => '',
            'devtype' => 'Android',
            'clientid' => '100',
            'servertime' => now()->getTimestamp(),
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => get_settings('shein_uid'),
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => get_settings('smdeviceid'),
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'appversion' => '8.7.6',
            'newuid' => get_settings('shein_uid'),
            'language' => 'en',
            'currency' => 'MYR',
            'network-type' => 'WIFI',
            'token' => get_token(),
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => get_settings('x-gw-auth')
        ];
        $request = new Request('GET', 'https://api-service.shein.com/order/cod/verify/free?billno=' . $billno, $headers);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }
}
