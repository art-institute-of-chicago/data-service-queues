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

        $contents = curl_exec($ch);

        curl_close($ch);

        return $contents;

    }

}
