<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PtoCController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontsite;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [Frontsite::class, "index"]);


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/banner', function() {
        return view('dashboard.banner.index');
    });

    Route::resource("/banner", BannerController::class);

    Route::post('/banner/isShown/{banner}', 'App\Http\Controllers\BannerController@isShown')->name('banner.isShown');

    Route::get('/projects', function() {
        return view('dashboard.projects.index');
    });
    Route::resource("/projects", projectController::class);



    Route::get('/categories', function() {
        return view('dashboard.categories.index');
    });

    Route::resource("/categories", CategoryController::class);

    Route::get('/projectToCategory', [PtoCController::class, 'index']);
    Route::get('/storeprojecttocategory', [PtoCController::class, 'store'])->name('storeprojecttocategory');

});
