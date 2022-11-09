<?php

use App\Http\Controllers\api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::options('{any}', function () {
    return response('OK', 204)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

Route::group(['middleware' => [],], function () {

    Route::post('/articles/create', [ArticleController::class, 'create']);
    Route::get('/articles/recordslang', [ArticleController::class, 'recordslang']);
    Route::put('/articles/{id}/{key}/update', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}/delete', [ArticleController::class, 'delete']);
    Route::get('/articles/record/{id}/{lang}', [ArticleController::class, 'record']);
    Route::get('/articles/{lang}/records', [ArticleController::class, 'records']);
});
