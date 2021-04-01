<?php

use App\Http\Controllers\SearchController;
use App\Models\Cartographer;
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

Route::view('/', 'welcome');
Route::view('search', 'search', ['people' => Cartographer::all()]);
Route::post('/search', SearchController::class);
