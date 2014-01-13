<?php

function dump_var($expression, $die = false) {
    echo "<PRE><CODE>" . var_export($expression, 1) . '</CODE></PRE>';
    if ($die) {
        die();
    }
}

function root_uri($path = "") {
    $type = Config::get("CoreCms::directions.type");
    $uri = Config::get("CoreCms::directions.uri");
    if ($type === "uri" || $type === "all") {
        return '/' . $uri . $path;
    } else {
        return "" . $path;
    }
}

/**
 * 
 * @param type $resource
 * @param type $controller
 */
function add_routes_resources($resource, $controller) {
    Route::get(root_uri() . '/' . $resource, array('as' => 'admin.' . $resource . '.index', 'uses' => $controller . "@index"));
    Route::get(root_uri() . '/' . $resource . '/create', array('as' => 'admin.' . $resource . '.create', 'uses' => $controller . "@create"));
    Route::post(root_uri() . '/' . $resource . '/store', array('as' => 'admin.' . $resource . '.store', 'uses' => $controller . "@store"));
    Route::get(root_uri() . '/' . $resource . '/{id}/' . 'edit', array('as' => 'admin.' . $resource . '.edit', 'uses' => $controller . "@edit"));
    Route::put(root_uri() . '/' . $resource . '/{id}/' . 'update', array('as' => 'admin.' . $resource . '.update', 'uses' => $controller . "@update"));
    Route::put(root_uri() . '/' . $resource . '/{id}/' . 'destroy', array('as' => 'admin.' . $resource . '.destroy', 'uses' => $controller . "@destroy"));
}
