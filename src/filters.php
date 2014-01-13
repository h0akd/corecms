<?php

Route::filter('loged', function() {
    if (!Sentry::check()) {
        return Redirect::route('admin.signin');
    }
});

Route::filter('notloged', function() {
    if (Sentry::check()) {
        return Redirect::route('admin.home');
    }
});