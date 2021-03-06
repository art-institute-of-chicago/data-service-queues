<?php

namespace App;

trait SourceCallable
{

    protected function call($path)
    {
        $url = config('source.api_url') . $path;
        $proxy = env('CURL_PROXY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        if ($result === false) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }

}
