<?php

Route::filter('loged', function() {

    if (Sentry::getUser() == null || !Sentry::check()) {
        if (Request::ajax()) {
            return App::abort(401);
        } else {
            return Redirect::route('admin.signin');
        }
    } 
});

Route::filter('notloged', function() {
    if (Sentry::check()) {
        return Redirect::route('admin.home');
    }
});
