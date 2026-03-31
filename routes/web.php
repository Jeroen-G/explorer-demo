<?php

use App\Ai\Agents\Librarian;
use App\Http\Controllers\AggregateController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\SearchController;
use App\Models\Cartographer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Spatie\MarkdownResponse\Facades\Markdown;
use Spatie\MarkdownResponse\Middleware\ProvideMarkdownResponse;

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
Route::get('/search', [SearchController::class, 'show']);
Route::post('/search', [SearchController::class, 'search']);
Route::get('/list', ListController::class);
Route::get('/aggregations', AggregateController::class);

Route::get('/agent', function () {
    return (new Librarian)->prompt('Search through documents and return the list of cartographers from Netherlands or France from the Enlightenment');
});

