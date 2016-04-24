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
    Route::get('/', 'ItemController@index');

    /**
     * Item routes
     */
    Route::group(['prefix' => 'items'], function () {
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
        });
    });

    /**
     * Job routes
     */
    Route::group(['prefix' => 'jobs'], function () {
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
        });

        /**
        * Permission: creating
        */
        Route::group(['middleware' => ['permission:create-jobs']], function () {
            Route::get('/create', 'JobController@create');
            Route::post('/create', 'JobController@store');
        });

        /**
        * Permission: managing job items
        */
        Route::group(['middleware' => ['permission:manage-job-items']], function () {
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
});

Route::auth();
Route::get('/register', 'Auth\AuthController@showLoginForm');
