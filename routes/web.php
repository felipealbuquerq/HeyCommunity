<?php

//
// web view share info
include_once 'web-view-share.php';


//
// Home
Route::group([], function () {
    // Route::get('/', 'HomeController@index')->name('home.index');

    Route::get('home', function () {
        return redirect()->route('news.index');
    })->name('home');

    Route::get('/', function () {
        return redirect()->route('news.index');
    })->name('index');

    Route::get('mini-app', function () {
        return redirect()->route('site.weather-forecast');
    });
});


//
// Site
Route::group([], function () {
    Route::get('page/{id}', 'SiteController@page')->name('site.page')->where('id', '[0-9]+');
    Route::get('about', 'SiteController@about')->name('site.about');
    Route::get('help', 'SiteController@help')->name('site.help');
    Route::get('terms', 'SiteController@terms')->name('site.terms');
    Route::get('privacy', 'SiteController@privacy')->name('site.privacy');
    Route::get('weather-forecast', 'SiteController@weatherForecast')->name('site.weather-forecast');
    Route::get('weather-forecast-source', function () {
        return '
                <iframe src="//www.seniverse.com/weather/weather.aspx?uid=UEA0895246&cid=CHJX060000&l=&p=SMART&a=1&u=C&s=3&m=0&x=1&d=3&fc=&bgc=&bc=&ti=0&in=0&li="
                        frameborder="0" scrolling="no" width="100%" height="110" allowTransparency="true"></iframe>
        ';
    });
});


//
// Other
Route::group([], function () {
    Route::post('simditor-upload-images', 'UploadController@simditorUploadImages')->name('upload.simditor-upload-images');
    Route::post('ckeditor-upload-images', 'UploadController@ckeditorUploadImages')->name('upload.ckeditor-upload-images');
});


//
// Timeline
Route::post('timeline/upload-image', 'TimelineController@uploadImage')->name('timeline.upload-image');
Route::resource('timeline', 'TimelineController');
Route::resource('timeline-comment', 'TimelineCommentController');


//
// User
Route::group(['prefix' => 'user', 'middleware' => []], function () {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('log-in', 'UserController@login')->name('login');
        Route::get('login', 'UserController@login')->name('user.login');
        Route::get('signup', 'UserController@signup')->name('user.signup');

        Route::get('default-signup', 'UserController@defaultSignup')->name('user.default-signup');
        Route::post('default-signup', 'UserController@defaultSignupHandler')->name('user.default-signup-handler');
        Route::get('default-login', 'UserController@defaultLogin')->name('user.default-login');
        Route::post('default-login', 'UserController@defaultLoginHandler')->name('user.default-login-handler');

        Route::get('login-wechat', 'UserController@loginWechat')->name('user.login-wechat');
    });

    Route::get('logout', 'UserController@logout')->name('user.logout');
    Route::get('login-by-wechat', 'UserController@loginByWechat')->middleware(['wechat.oauth', 'auth.wechat'])->name('user.login-by-wechat');
    Route::post('login-by-wechat-handler', 'UserController@loginByWechatHandler')->name('user.login-by-wechat-handler');
    Route::get('login-by-wechat-success', 'UserController@loginByWechatSuccess')->name('user.login-by-wechat-success');

    Route::middleware(['auth'])->group(function () {
        Route::get('ucenter/index', 'User\UCenterController@index')->name('user.ucenter');
        Route::get('ucenter/profile', 'User\UCenterController@profile')->name('user.ucenter.profile');
        Route::get('ucenter/profile-edit', 'User\UCenterController@profileEdit')->name('user.ucenter.profile-edit');
        Route::post('ucenter/profile-update', 'User\UCenterController@profileUpdate')->name('user.ucenter.profile-update');
        Route::get('ucenter/realname-verify', 'User\UCenterController@realnameVerify')->name('user.ucenter.realname-verify');
        Route::get('ucenter/setting-notice', 'User\UCenterController@settingNotice')->name('user.ucenter.setting-notice');
        Route::get('ucenter/security-center', 'User\UCenterController@securityCenter')->name('user.ucenter.security-center');

        Route::post('ucenter/avatar-update', 'User\UCenterController@avatarUpdate')->name('user.ucenter.avatar-update');
        Route::post('ucenter/profile-bg-img-update', 'User\UCenterController@profileBgImgUpdate')->name('user.ucenter.profile-bg-img-update');


        Route::get('toggle-sock-puppet/{id}', 'UserController@toggleSockPuppet')
            ->where('id', '[0-9]+')
            ->name('user.toggle-sock-puppet');
    });

    Route::get('uhome/{id}/index', 'User\UhomeController@index')->name('user.uhome');
    Route::get('uhome/{id}/timeline', 'User\UhomeController@timeline')->name('user.uhome.timeline');
    Route::get('uhome/{id}/topic-published', 'User\UhomeController@topicPublished')->name('user.uhome.topic-published');
    Route::get('uhome/{id}/topic-replies', 'User\UhomeController@topicReplies')->name('user.uhome.topic-replies');
    Route::get('uhome/{id}/activity', 'User\UhomeController@activity')->name('user.uhome.activity');
});


//
// Notice
Route::group(['prefix' => 'notice', 'middleware' => ['wechat.oauth', 'auth.wechat', 'auth']], function () {
    Route::get('/', 'NoticeController@index')->name('notice.index');
    Route::post('check', 'NoticeController@check')->name('notice.check');
});


//
// News
Route::group(['prefix' => 'news', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/{id}', 'NewsController@show')->name('news.show')->where('id', '[0-9]+');
});


//
// Post
Route::group(['prefix' => 'post', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::get('/{id}', 'PostController@show')->name('post.show')->where('id', '[0-9]+');

    Route::middleware(['auth'])->group(function() {
        Route::get('create', 'PostController@create')->name('post.create');
        Route::post('store', 'PostController@store')->name('post.store');
        Route::get('edit/{id}', 'PostController@edit')->name('post.edit')->where('id', '[0-9]+');
        Route::post('update/{id}', 'PostController@update')->name('post.update')->where('id', '[0-9]+');
    });
});


//
// Topic
Route::group(['prefix' => 'topic', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'TopicController@index')->name('topic.index');
    Route::get('/{id}', 'TopicController@show')->name('topic.show')->where('id', '[0-9]+');

    Route::middleware(['auth'])->group(function() {
        Route::get('create', 'TopicController@create')->name('topic.create');
        Route::get('edit/{id}', 'TopicController@edit')->name('topic.edit')->where('id', '[0-9]+');
        Route::post('update/{id}', 'TopicController@update')->name('topic.update')->where('id', '[0-9]+');
        Route::post('store', 'TopicController@store')->name('topic.store');
        Route::post('thumb', 'TopicController@thumb')->name('topic.thumb');
        Route::post('favorite', 'TopicController@favorite')->name('topic.favorite');
        Route::post('destroy', 'TopicController@destroy')->name('topic.destroy');

        // Topic Comment
        Route::group(['prefix' => 'comment'], function () {
            Route::post('store', 'TopicCommentController@store')->name('topic.comment.store');
            Route::post('reply', 'TopicCommentController@reply')->name('topic.comment.reply');
            Route::post('thumb', 'TopicCommentController@thumb')->name('topic.comment.thumb');
            Route::post('destroy', 'TopicCommentController@destroy')->name('topic.comment.destroy');
        });
    });
});


//
// Activity
Route::group(['prefix' => 'activity', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'ActivityController@index')->name('activity.index');
    Route::get('/{id}', 'ActivityController@show')->name('activity.show')->where('id', '[0-9]+');

    Route::middleware(['auth'])->group(function() {
        Route::get('create', 'ActivityController@create')->name('activity.create');
        Route::post('store', 'ActivityController@store')->name('activity.store');
        Route::get('edit/{id}', 'ActivityController@edit')->name('activity.edit')->where('id', '[0-9]+');
        Route::post('update/{id}', 'ActivityController@update')->name('activity.update')->where('id', '[0-9]+');
    });
});


//
// Activity Comment
Route::group(['middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::resource('activity-comment', 'ActivityCommentController');
});


//
// Daily
Route::group(['prefix' => 'daily', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'DailyPaperController@index')->name('daily.index');
});


//
// Columns
Route::group(['prefix' => 'column', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'ColumnistController@index')->name('columnist.index');

    Route::get('{id}', 'ColumnController@show')->name('column.show')->where('id', '[0-9]+');
    Route::get('{id}/edit', 'ColumnController@edit')->name('column.edit')->where('id', '[0-9]+');
    Route::post('{id}/update', 'ColumnController@update')->name('column.update')->where('id', '[0-9]+');
    Route::post('{id}/destroy', 'ColumnController@destroy')->name('column.destroy')->where('id', '[0-9]+');

    Route::get('{domain}/create', 'ColumnController@create')->name('column.create')->where('domain', '^\w\S+');
    Route::post('{domain}', 'ColumnController@store')->name('column.store')->where('domain', '^\w\S+');
    Route::get('{domain}', 'ColumnistController@show')->name('columnist.show')->where('domain', '^\w\S+');
});


//
// Comment
Route::group(['middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::resource('comment', 'CommentController');
});


//
// web admin routes
include_once 'web-admin.php';
