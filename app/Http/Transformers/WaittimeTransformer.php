<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class WaittimeTransformer extends AbstractTransformer
{

    public function transform($waittime)
    {

        $data = [
            'id' => (int) $waittime->id,
            'duration' => (int) $waittime->duration,
            'units' => $waittime->units,
            'display' => $waittime->display,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
