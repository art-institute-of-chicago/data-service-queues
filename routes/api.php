<?php

Route::get('/', function () {
    return redirect('/api/v1');
});

Route::group(['prefix' => 'v1'], function() {

    Route::get('wait-times/{id}', 'WaittimesController@show');

});
