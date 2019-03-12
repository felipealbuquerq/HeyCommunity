<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth.admin']], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');

    //
    // Home
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('admin.home.index');
    });

    //
    // User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.index');
    });

    //
    // News
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@index')->name('admin.news.index');
        Route::post('destroy', 'NewsController@destroy')->name('admin.news.destroy');
    });

    //
    // Topic
    Route::group(['prefix' => 'topic'], function () {
        Route::get('/', 'TopicController@index')->name('admin.topic.index');
        Route::post('destroy', 'TopicController@destroy')->name('admin.topic.destroy');

        Route::group(['prefix' => 'node'], function () {
            Route::get('/', 'TopicNodeController@index')->name('admin.topic.node.index');
            Route::post('to-left', 'TopicNodeController@toLeft')->name('admin.topic.node.to-left');
            Route::post('to-right', 'TopicNodeController@toRight')->name('admin.topic.node.to-right');
            Route::post('destroy', 'TopicNodeController@destroy')->name('admin.topic.node.destroy');
            Route::post('store', 'TopicNodeController@store')->name('admin.topic.node.store');
            Route::post('update', 'TopicNodeController@update')->name('admin.topic.node.update');
        });
    });

    //
    // activities
    Route::group(['prefix' => 'activity'], function () {
        Route::get('/', 'ActivityController@index')->name('admin.activity.index');
        Route::post('destroy', 'ActivityController@destroy')->name('admin.activity.destroy');
    });

    //
    // Daily Paper
    Route::resource('daily-paper', 'DailyPaperController', ['as' => 'admin']);

    //
    // Operation & Analytics
    Route::group([], function () {
        Route::get('request-recorder/rank-index', 'RequestRecorderController@rankIndex')->name('admin.request-recorder.rank-index');
        Route::resource('request-recorder', 'RequestRecorderController', ['as' => 'admin']);
    });

    //
    // System
    Route::group(['prefix' => 'system'], function () {
        Route::get('edit', 'SystemController@edit')->name('admin.system.edit');
        Route::post('update', 'SystemController@update')->name('admin.system.update');
    });
});
