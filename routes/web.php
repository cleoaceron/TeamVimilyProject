<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "admin"], function() use ($router) {

	$router->group(["prefix" => "user"], function() use ($router) {

		$router->post("add", ["as" => "admin.user.add", "uses" => "UserController@addUser"]);
		$router->post("update/{uuid}", ["as" => "admin.user.update", "uses" => "UserController@updateUser"]);
		$router->post("delete", ["as" => "admin.user.delete", "uses" => "UserController@deleteUser"]);
		$router->get("view/{uuid}", ["as" => "admin.user.view", "uses" => "UserController@viewUser"]);
		$router->post("list[/{page:\d+}]", ["as" => "admin.user.list", "uses" => "UserController@getUserList"]);

	});

});
