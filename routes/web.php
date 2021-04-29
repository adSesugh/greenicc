<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontierController;
use App\Http\Controllers\EnquiryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontierController::class, 'index'])->name('index');
Route::get('/about-us', [FrontierController::class, 'aboutus'])->name('aboutus');
Route::get('/services', [FrontierController::class, 'service'])->name('service');
Route::get('/trending-news', [FrontierController::class, 'news'])->name('news');
Route::get('/project', [FrontierController::class, 'project'])->name('project');
Route::get('/gallery', [FrontierController::class, 'gallery'])->name('gallery');
Route::get('/contact', [FrontierController::class, 'contact'])->name('contact');
Route::post('/contact', [EnquiryController::class, 'store'])->name('pstore');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/slides', App\Http\Controllers\SlideController::class)->except(['show', 'destroy']);
    Route::post('/slides/{id}/action', [App\Http\Controllers\SlideController::class, 'markAs'])->name('slides.action');

    Route::group(['prefix' => 'services'], function(){
        Route::resource('/categories', App\Http\Controllers\CategoryController::class)->except(['show', 'destroy']);
        Route::post('/categories/{id}/action', [App\Http\Controllers\CategoryController::class, 'markAs'])->name('categories.action');
        Route::resource('/best_services', App\Http\Controllers\BestServiceController::class)->except(['show', 'destroy']);
        Route::post('/best_services/{id}/action', [App\Http\Controllers\BestServiceController::class, 'markAs'])->name('best_services.action');
    });

    Route::resource('/coreValues', App\Http\Controllers\WhyChooseUsController::class)->except(['show', 'destroy', 'create']);
    Route::any('/coreValues/{id}/update', [App\Http\Controllers\WhyChooseUsController::class, 'update'])->name('update.coreValues');
    Route::post('coreValues/{id}/action', [App\Http\Controllers\WhyChooseUsController::class, 'markAs'])->name('coreValues.action');

    Route::resource('/clients', App\Http\Controllers\ClientController::class)->except(['show', 'destroy', 'update']);
    Route::any('/clients/{id}/update', [App\Http\Controllers\ClientController::class, 'updateClient'])->name('update.client');
    Route::post('/clients/{id}/action', [App\Http\Controllers\ClientController::class, 'markAs'])->name('clients.action');

    Route::resource('/teams', App\Http\Controllers\TeamController::class)->except(['show', 'destroy']);
    Route::post('/teams/{id}/action', [App\Http\Controllers\TeamController::class, 'markAs'])->name('teams.action');

    Route::resource('/testimonials', App\Http\Controllers\TestimonialController::class)->except(['show', 'destroy']);
    Route::post('/testimonials/{id}/action', [App\Http\Controllers\TestimonialController::class, 'markAs'])->name('testimonials.action');

    Route::resource('/projects', App\Http\Controllers\ProjectController::class)->except(['destroy']);
    Route::any('/projects/{id}/update', [App\Http\Controllers\ClientController::class, 'update'])->name('update.project');
    Route::post('/projects/{id}/action', [App\Http\Controllers\ProjectController::class, 'markAs'])->name('projects.action');

    Route::resource('/news', App\Http\Controllers\NewsController::class)->except(['destroy']);
    Route::post('/news/{id}/action', [App\Http\Controllers\NewsController::class, 'markAs'])->name('news.action');

    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\SettingController::class, 'store'])->name('settings.store');
    Route::post('/settings/update', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

    Route::resource('/media', App\Http\Controllers\GalleryController::class)->except(['show', 'destroy', 'edit', 'update']);;
    // Route::get('media/create', [App\Http\Controllers\GalleryController::class, 'create'])->name('media.create');
    // Route::post('media/create', [App\Http\Controllers\GalleryController::class, 'store'])->name('media.store');

    Route::get('/getType', [App\Http\Controllers\GalleryController::class, 'getType'])->name('ctypes');

    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiry.index');
});


// Route::get('beachland', function(){
//     $conn = mysqli_connect('10.43.51.3', 'eclinicplus', 'heliport1', 'eclinicplus');
//     if($conn) {
//         echo 'Connected to db';
//     }
//     else {
//         echo 'Failed to connect';
//     }
// });


