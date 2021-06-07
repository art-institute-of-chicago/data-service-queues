<?php

namespace App;

use Illuminate\Support\Str;

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
        $result = $this->call("/kiosk/data/" . config('source.api_key') . "?serial=web");
        $json = json_decode($result);

        if ($json === null && json_last_error() !== JSON_ERROR_NONE) {
           throw new \Exception(json_last_error());
        }

        foreach ($json as $queue) {
            if ($queue->queueId == $id) {
                $waittime = new static;
                $waittime->fillFrom($queue);

                return $waittime;
            }
        }

        return null;
    }

    public function fillFrom($source)
    {
        $this->id = $source->queueId;
        $this->duration = $source->waitTime;
        $this->units = 'minutes';
        $this->display = $source->waitTime . ' ' . Str::plural('minutes', $source->waitTime);
    }
}
