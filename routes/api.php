<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller('\App\Http\Controllers\Api\AuthController')->group(function () {
    Route::post('register', 'register'); // Signup
    Route::post('login', 'login'); // login
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', '\App\Http\Controllers\Api\AuthController@logout'); // login
    Route::get('getalltasks', '\App\Http\Controllers\Api\TaskController@getAllTasks'); // login
    Route::get('submit/{id}', '\App\Http\Controllers\Api\TaskController@submitTask'); // login
    Route::resources([
        'project' => ProjectController::class,
        'task' => TaskController::class,
    ]);
});
