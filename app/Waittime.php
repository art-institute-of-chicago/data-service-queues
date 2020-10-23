<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Waittime extends BaseModel
{

    use SourceCallable;
    use Singletonable;

    public $id;
    public $duration;
    public $units;
    public $display;

    public function find($id)
    {

        $result = $this->call("/kiosk/queues/{$id}/waitInfo");

        $xml=simplexml_load_string($result);

        $response = $xml->waitInfo;
        if ($response && $xml->getName() == "waitInfos")
        {

            $waittime = new static;
            $waittime->fillFrom($response);

            return $waittime;
        }

        return null;
    }

    public function fillFrom($source)
    {
        $this->id = head($source->attributes()->queueId);
        $this->duration = head($source->forecastNextWaitTime->attributes()->duration);
        $this->units = head($source->forecastNextWaitTime->attributes()->units);
        $this->display = (string) $source->forecastNextWaitTime;

    }
}
