<?php

namespace App;

trait SourceCallable
{

    protected function call($path)
    {

        $url = config('source.api_url') . $path;
        return file_get_contents($url);

    }

}
