<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class WaittimesController extends BaseController
{

    protected $model = \App\Waittime::class;

    protected $transformer = \App\Http\Transformers\WaittimeTransformer::class;

    /**
     * Call to find specific id(s). Override this method when logic to get
     * a model is more complex than a simple `$model::find($id)` call.
     *
     * @param mixed $ids
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function find($ids)
    {

        return ($this->model)::instance()->find($ids);

    }
}
