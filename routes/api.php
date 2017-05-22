<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

    Route::resource('doors', 'DoorsController');

    Route::resource('stautuses', 'StautusesController');

    Route::resource('pasts', 'PastsController');

    Route::post('login', 'LoginController@login')->name('login.post')->middleware('cors');;
    Route::get('login', function (Request $request) {


        return 2;
        // return $request->smartapp();
    })->name('login.get')->middleware('cors');
    Route::post('register', 'LoginController@register')->name('register.post')->middleware('cors');

    Route::get('/alldata/{token?}/{door_key?}', 'DataController@allData')->middleware('cors');
    Route::post('/alldata', 'DataController@allDatasPost')->middleware('cors');
    Route::post('schedule', 'DataController@scheduleData')->middleware('cors');
    Route::post('userdata', 'DataController@userData')->middleware('cors');

    Route::get('opendoor','DataController@opendoor');

    Route::get('opendoor/{door_key}/{id}', 'DataController@opendoorByToken');

    Route::get('updatestatus/{door_key}','DataController@updateStatus');

    Route::get('updatestatus/{door_key}/{door_action}/{door_visitor}','DataController@updateStatusRasp');
    Route::get('notification','DataController@notification');
});



