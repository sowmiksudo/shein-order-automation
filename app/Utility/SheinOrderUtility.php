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
            'verify' => false
        ]);
    }

    public function get_product_info($goods_id)
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
            'servertime' => '1671815552',
            'accept' => 'application/json',
            'device' => 'realmeC25Series Android12',
            'usercountry' => 'MY',
            'applanguage' => 'en',
            'version' => '8.7.6',
            'devicelanguage' => 'en',
            'sortuid' => '1103207067',
            'dev-id' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'device_language' => 'en',
            'apptype' => 'shein',
            'localcountry' => 'MY',
            'smdeviceid' => '20221209170825cbb532d50ef9f8ec2b2b5ed9f35d607701fab349c3378c0d',
            'deviceid' => 'shein_4d716643-e8fa-32d8-9aa8-f5bcafc91a44',
            'appname' => 'shein app',
            'newuid' => '1103207067',
            'appversion' => '8.7.6',
            'language' => 'en',
            'currency' => 'MYR',
            'network-type' => 'WIFI',
            'os-version' => '12',
            'devicesystemversion' => 'Android12',
            'appcurrency' => 'MYR',
            'user-agent' => 'Shein 8.7.6 Android 12 realme C25 Series US en 1103207067',
            'accept-encoding' => 'gzip',
            'x-gw-auth' => 'a=vhOvoNStVeIKfdWT0Gp55rGPHqjicT@8.6.4&b=1671815604709&d=-884979813&e=u9kQ9YjMwMWU4OTc1MjQzNDJlMzZjNGU0ZjYyYjgwNjEzN2Y5OTJmNjg4N2M4NzJmZmZkZmNkM2Q4Y2VkNjIzZTA1ZQ%3D%3D',
            'Cookie' => '__cf_bm=FROhrR.NL_kcGs1DTk8zwT6wadIVwwTqgqSutxp6uWs-1672922307-0-AdwPge2HYqEHHrHW7F2UUQc9Hr3Sn32yBhsi6WomKYwWI4EEJYDBeUTS+3Xh5VFspVTkbyudiHerYQv4IEaamcA='
        ];
        $request = new Request('GET', 'https://api-service.shein.com/product/get_goods_detail_first_part?rule_id=is_pde%3D3%26rule_id%3Drec_ver%3AS93V1.0&userSwitchLocalCountry=&recPdRuleIdAbtParam=is_pde%3D3%26rule_id_122%3Drec_ver%3AS122V1.0&userSwitchSizeUnit=&mall_code=1&abtParamsCCCTemplate=&abtParamsSkcOut=type%3DB&goods_id=' . $goods_id . '&abtParamsProd2Body=rule%3D1727_1766_767%3AB&recStoreGoodsAbtParam=', $headers);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
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


    public function order_sum($billno)
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
        $request = new Request('GET', 'https://api-service.shein.com/order/get_order_detail?page_from=pay_success&billno=' . $billno, $headers);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }

    public function send_update($order)
    {
        $order = $order->fresh();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('APP_MAIN').'/api/orders/shein/update',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "order_id={$order->order_id}&order_details_id={$order->order_details_id}&status={$order->status}",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        log_res($response, "UPDATE ORDER STATUS {$order->order_details_id} | {$order->status}");
        return $response;
    }
}
