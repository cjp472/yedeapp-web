<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    /**
     * Translate text into english with slug format
     *
     * @param  string  $text
     * @return string
     */
    public function translate($text)
    {
        // Create a new HTTP client instance.
        $http = new Client;

        // Baidu translate Config
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $key = config('services.baidu_translate.key');
        $salt = time();

        // Use pinyin when no baidu translator config
        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        // Compose sign for baidu translator
        // http://api.fanyi.baidu.com/api/trans/product/apidoc
        // md5(appid + q + salt + key)
        $sign = md5($appid . $text . $salt . $key);

        // Build translate query
        $query = http_build_query([
            'q' => $text,
            'from' => 'zh',
            'to' => 'en',
            'appid' => $appid,
            'salt' => $salt,
            'sign' => $sign
        ]);

        // Send query to baidu
        $response = $http->get($api.$query);

        // Get result
        $result = json_decode($response->getBody(), true);
        
        // Return translate result.
        if (isset($result['trans_result'][0]['dst'])) {
            return str_slug($result['trans_result'][0]['dst']);
        } else {
            // If baidu translate's no work, go pinyin.
            return $this->pinyin($text);
        }
    }

    /**
     * Translate text into pinyin
     *
     * @param  string  $text
     * @return string
     */
    public function pinyin($text)
    {
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}