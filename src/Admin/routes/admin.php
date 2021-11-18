<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.home');
})->name('admin.home');

$editRoutes = [
    [
        'route' => 'users',
        'controller' => \App\Http\Controllers\Admin\UserController::class,
        'actions' => [
            'edit',
            'delete',
        ]
    ],
];

foreach ($editRoutes as $route) {
    $actions = array_merge([
        '',
    ], $route['actions'] ?? []);
    foreach ($actions as $action) {
        $routeName = $route['route'] . ($action ? '-' . $action : '');
        $controllerAction = $action ? \Illuminate\Support\Str::camel($action) : 'index';

        $actionString = $action ? '/' . $action : '';

        $basicRouteUrl = '/' . $route['route'] . $actionString;
        Route::any(
            $basicRouteUrl,
            [$route['controller'], $controllerAction]
        )->name($routeName);
    }
}
