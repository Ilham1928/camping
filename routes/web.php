<?php

$router->group(['namespace' => 'Main'], function () use ($router) {
    // auth route
    $router->group(['prefix' => '/'], function () use ($router) {
        $router->get('/', 'Auth\AuthController@index');
        $router->post('/login', 'Auth\AuthController@login');
        $router->post('/register', 'Auth\AuthController@register');
        $router->get('/logout', 'Auth\AuthController@logout');
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {

        // configuration side menu route
        $router->group(['prefix' => '/menu/config'], function () use ($router) {
            $router->get('/', 'Menu\ConfigController@index');
            $router->post('/update/{id}', 'Menu\ConfigController@update');
        });

        $router->group(['prefix' => '/menu/icon'], function () use ($router) {
            $router->get('/data', 'Menu\IconController@getData');
            $router->get('/', 'Menu\IconController@index');
            $router->get('/add', 'Menu\IconController@add');
            $router->post('/save', 'Menu\IconController@save');
            $router->get('/edit/{id}', 'Menu\IconController@edit');
            $router->post('/update/{id}', 'Menu\IconController@update');
            $router->get('/delete', 'Menu\IconController@delete');
            $router->post('/delete/many', 'Menu\IconController@bulkDelete');
        });

        $router->group(['prefix' => '/menu/parent'], function () use ($router) {
            $router->get('/data', 'Menu\ParentController@getData');
            $router->get('/', 'Menu\ParentController@index');
            $router->get('/add', 'Menu\ParentController@add');
            $router->post('/save', 'Menu\ParentController@save');
            $router->get('/edit/{id}', 'Menu\ParentController@edit');
            $router->post('/update/{id}', 'Menu\ParentController@update');
            $router->get('/delete', 'Menu\ParentController@delete');
            $router->post('/delete/many', 'Menu\ParentController@bulkDelete');
            $router->get('/get-icon', 'Menu\ParentController@getIcon');
        });

        $router->group(['prefix' => '/menu/child'], function () use ($router) {
            $router->get('/data', 'Menu\ChildController@getData');
            $router->get('/', 'Menu\ChildController@index');
            $router->get('/add', 'Menu\ChildController@add');
            $router->post('/save', 'Menu\ChildController@save');
            $router->get('/edit/{id}', 'Menu\ChildController@edit');
            $router->post('/update/{id}', 'Menu\ChildController@update');
            $router->get('/delete', 'Menu\ChildController@delete');
            $router->post('/delete/many', 'Menu\ChildController@bulkDelete');
            $router->get('/get-parent', 'Menu\ChildController@getParent');
        });


        // application route
        $router->group(['prefix' => '/search'], function () use ($router) {
            $router->get('/', 'Search\SearchController@index');
        });

        $router->group(['prefix' => '/dashboard'], function () use ($router) {
            $router->get('/', 'Dashboard\DashboardController@index');
            $router->get('/detail-item', 'Dashboard\DashboardController@detail');
        });

        $router->group(['namespace' => 'Admin'], function () use ($router) {
            $router->group(['prefix' => '/admin-master'], function () use ($router) {
                $router->get('/data', 'AdminController@getData');
                $router->get('/', 'AdminController@index');
                $router->get('/add', 'AdminController@add');
                $router->post('/save', 'AdminController@save');
                $router->get('/detail/{id}', 'AdminController@detail');
                $router->get('/edit/{id}', 'AdminController@edit');
                $router->post('/update/{id}', 'AdminController@update');
                $router->get('/delete', 'AdminController@delete');
                $router->post('/delete/many', 'AdminController@bulkDelete');
                $router->get('/get-roles', 'AdminController@getRoles');
            });

            $router->group(['prefix' => '/admin-roles'], function () use ($router) {
                // the role here
                $router->get('/data', 'RoleController@getData');
                $router->get('/', 'RoleController@index');
                $router->get('/add', 'RoleController@add');
                $router->post('/save', 'RoleController@save');
                $router->get('/edit/{id}', 'RoleController@edit');
                $router->post('/update/{id}', 'RoleController@update');
                $router->get('/delete', 'RoleController@delete');
                $router->post('/delete/many', 'RoleController@bulkDelete');

                // the permission
                $router->get('/get-permission', 'PermissionController@getData');
                $router->get('/permission/{id}', 'PermissionController@index');
                $router->get('/permission/{id}/save', 'PermissionController@save');
            });
        });

        $router->group(['namespace' => 'Item'], function () use ($router) {
            $router->group(['prefix' => '/item-master'], function () use ($router) {
                $router->get('/data', 'ItemMasterController@getData');
                $router->get('/', 'ItemMasterController@index');
                $router->get('/add', 'ItemMasterController@add');
                $router->post('/save', 'ItemMasterController@save');
                $router->get('/detail/{id}', 'ItemMasterController@detail');
                $router->get('/edit/{id}', 'ItemMasterController@edit');
                $router->post('/update/{id}', 'ItemMasterController@update');
                $router->get('/delete', 'ItemMasterController@delete');
                $router->post('/delete/many', 'ItemMasterController@bulkDelete');
                $router->get('/get-category', 'ItemMasterController@getCategory');
            });

            $router->group(['prefix' => '/item-category'], function () use ($router) {
                $router->get('/data', 'ItemCategoryController@getData');
                $router->get('/', 'ItemCategoryController@index');
                $router->get('/add', 'ItemCategoryController@add');
                $router->post('/save', 'ItemCategoryController@save');
                $router->get('/detail/{id}', 'ItemCategoryController@detail');
                $router->get('/edit/{id}', 'ItemCategoryController@edit');
                $router->post('/update/{id}', 'ItemCategoryController@update');
                $router->get('/delete', 'ItemCategoryController@delete');
                $router->post('/delete/many', 'ItemCategoryController@bulkDelete');
            });
        });

        $router->group(['namespace' => 'Guide'], function () use ($router) {
            $router->group(['prefix' => '/guide-master'], function () use ($router) {
                $router->get('/data', 'GuideController@getData');
                $router->get('/', 'GuideController@index');
                $router->get('/add', 'GuideController@add');
                $router->post('/save', 'GuideController@save');
                $router->get('/detail/{id}', 'GuideController@detail');
                $router->get('/edit/{id}', 'GuideController@edit');
                $router->post('/update/{id}', 'GuideController@update');
                $router->get('/delete', 'GuideController@delete');
                $router->post('/delete/many', 'GuideController@bulkDelete');
            });
        });

        $router->group(['namespace' => 'Order'], function () use ($router) {
            $router->group(['prefix' => '/order-master'], function () use ($router) {
                $router->get('/data', 'OrderController@getData');
                $router->get('/', 'OrderController@index');
                $router->get('/detail/{id}', 'OrderController@detail');
                $router->post('/save', 'OrderController@save');
            });
        });
    });
});
