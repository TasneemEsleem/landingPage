<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ChooseController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubScribeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contactus', [ContactUsController::class, 'store']);
Route::post('/subscribe', [SubScribeController::class, 'store']);
// Page Choose
Route::get('/Choose/index', [ChooseController::class, 'index'])->name('choose.index');
// Page ContactUs
Route::get('/page/contactus', [ContactUsController::class, 'contanct'])->name('page.contactus');
// Page AboutUs
Route::get('/page/AboutUs', [AboutUsController::class, 'about'])->name('page.about');
// Page Services
Route::get('/page/Service', [ServiceController::class, 'service'])->name('page.service');
// Page Team
Route::get('/page/Team', [TeamController::class, 'Team'])->name('page.Team');





Route::prefix('cms')->group(function () {
    Route::resource('sliders', SliderController::class);  
    Route::post('changeStatus/{id}', [SliderController::class, 'changeStatus'])->name('changeStatus');
    Route::resource('services', ServiceController::class);
    Route::post('service/changeStatus/{id}', [ServiceController::class, 'changeStatus'])->name('changeStatus');
    Route::resource('aboutus', AboutUsController::class);
    Route::post('aboutus/changeStatus/{id}', [AboutUsController::class, 'changeStatus'])->name('changeStatus');
    Route::resource('teams', TeamController::class);
    Route::post('team/changeStatus/{id}', [TeamController::class, 'changeStatus'])->name('changeStatus');
    Route::resource('informations', InformationController::class);
    Route::post('information/changeStatus/{id}', [InformationController::class, 'changeStatus'])->name('changeStatus');
    Route::get('/contactus/index', [ContactUsController::class, 'index'])->name('contactus.index');
    Route::get('/subscribe/index', [SubScribeController::class, 'index'])->name('subscribe.index');

   
 });
