<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'PagesController@index');

    Route::group(['middleware' => ['role:admin']], function () {
            Route::get('/leiter', 'PagesController@data');
    });

    Route::group(['prefix' => 'quick', 'middleware' => ['permission:view-items', 'permission:view-jobs']], function () {
        Route::get('/', 'QuickViewController@index');
    });

    /**
     * Item routes
     */
    Route::group(['prefix' => 'items'], function () {
        /**
         * Permission: creating
         */
        Route::group(['middleware' => ['permission:create-items']], function () {
            Route::get('/create', 'ItemController@create');
            Route::post('/create', 'ItemController@store');
        });

        /**
         * Permission: managing item types
         */
        Route::group(['middleware' => ['permission:manage-item-types']], function () {
            Route::get('/types', 'ItemTypeController@index');

            Route::post('/types/create', 'ItemTypeController@store');
            Route::post('/types/{id}', 'ItemTypeController@change');
            Route::post('/types/{id}/delete', 'ItemTypeController@delete');
        });

        /**
         * Permission: managing broken items
         */
        Route::group(['middleware' => ['permission:manage-broken-items']], function () {
            Route::get('/broken', 'BrokenItemController@index');
            Route::get('/{id}/broken', 'BrokenItemController@show');
            Route::get('/{id}/broken/report', 'BrokenItemController@report');
            Route::get('/{id}/broken/{broken_id}/edit', 'BrokenItemController@edit');

            Route::post('/{id}/broken/report', 'BrokenItemController@open');
            Route::post('/{id}/broken/{broken_id}/edit', 'BrokenItemController@change');
            Route::post('/{id}/broken/{broken_id}/close', 'BrokenItemController@close');
        });

        /**
         * Permission: viewing
         */
        Route::group(['middleware' => ['permission:view-items']], function () {
            Route::get('/', 'ItemController@index');
            Route::get('/{id}', 'ItemController@show');
        });

        /**
         * Permission: editing
         */
        Route::group(['middleware' => ['permission:edit-items']], function () {
            Route::get('/{id}/edit', 'ItemController@edit');
            Route::post('/{id}/edit', 'ItemController@change');
            Route::post('/{id}/delete', 'ItemController@delete');
        });
    });

    /**
     * Job routes
     */
    Route::group(['prefix' => 'jobs'], function () {
        /**
        * Permission: creating
        */
        Route::group(['middleware' => ['permission:create-jobs']], function () {
            Route::get('/create', 'JobController@create');
            Route::post('/create', 'JobController@store');
        });

        /**
        * Permission: viewing
        */
        Route::group(['middleware' => ['permission:view-jobs']], function () {
            Route::get('/', 'JobController@index');
            Route::get('/{id}', 'JobController@show');
        });

        /**
        * Permission: editing
        */
        Route::group(['middleware' => ['permission:edit-jobs']], function () {
            Route::get('/{id}/edit', 'JobController@edit');
            Route::post('/{id}/edit', 'JobController@change');
			Route::post('/{id}/delete', 'JobController@delete');
        });

        /**
        * Permission: managing job items
        */
        Route::group(['middleware' => ['permission:assign-job-items']], function () {
            Route::post('/{id}/items', 'JobController@changeItems');
        });
    });

    /**
     * User routes
     */
    Route::group(['prefix' => 'users', 'middleware' => ['permission:manage-users']], function () {
        Route::get('/', 'UserController@index');
        Route::get('/create', 'UserController@create');
        Route::get('/{id}', 'UserController@edit');

        Route::post('/create', 'UserController@store');
        Route::post('/{id}/edit', 'UserController@change');
        Route::post('/{id}/password', 'UserController@changePassword');
        Route::post('/{id}/delete', 'UserController@delete');
    });

	Route::group(['prefix' => 'funds', 'middleware' => ['permission:manage-funds']], function () {
        Route::get('/', 'FundController@index');

		Route::post('/', 'FundController@create');
		Route::put('/{fund}', 'FundController@update');
		Route::delete('/{fund}', 'FundController@delete');
    });
});

Route::auth();
Route::get('/register', 'Auth\AuthController@showLoginForm');
