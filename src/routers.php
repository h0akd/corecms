<?php


/**
 * 
 */
Route::get(root_uri() . "/", array("as" => "admin.home", "uses" => "H0akd\Corecms\Controllers\HomeController@index"))->before("loged");
Route::get(root_uri() . "/signin", array("as" => "admin.signin", "uses" => "H0akd\Corecms\Controllers\HomeController@signin"))->before("notloged");
Route::get(root_uri() . "/signout", array("as" => "admin.signout", "uses" => "H0akd\Corecms\Controllers\HomeController@signout"));
Route::post(root_uri() . "/authen", array("as" => "admin.authen", "uses" => "H0akd\Corecms\Controllers\HomeController@authen"))->before("notloged");
Route::get(root_uri() . "/home/sidenav", array("as" => "admin.home.sidenav", "uses" => "H0akd\Corecms\Controllers\HomeController@sidenav"));
Route::get(root_uri() . "/home/navbar", array("as" => "admin.home.navbar", "uses" => "H0akd\Corecms\Controllers\HomeController@navbar"));
Route::get(root_uri() . "/home/dashboard", array("as" => "admin.home.dashboard", "uses" => "H0akd\Corecms\Controllers\DashboardController@index"));


/**
 * 
 */
$type = Config::get("CoreCms::directions.type");
$uri = Config::get("CoreCms::directions.uri");
$domain = Config::get("CoreCms::directions.domain");


/**
 * 
 */
add_routes_resources("modules", "H0akd\Corecms\Controllers\ModuleController");
add_routes_resources("groups", "H0akd\Corecms\Controllers\GroupController");
add_routes_resources("permistions", "H0akd\Corecms\Controllers\PermistionController");
add_routes_resources("users", "H0akd\Corecms\Controllers\UserController");
Route::put(root_uri() . '/user/{id}/handactive', array('as' => 'admin.users.handactive', 'uses' => "H0akd\Corecms\Controllers\UserController@handactive"));
Route::get(root_uri() . '/user/{id}/change', array('as' => 'admin.users.change', 'uses' => "H0akd\Corecms\Controllers\UserController@change"));
Route::put(root_uri() . '/user/{id}/submitchange', array('as' => 'admin.users.submitchange', 'uses' => "H0akd\Corecms\Controllers\UserController@submitchange"));
