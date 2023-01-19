<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AuthController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/nesto', function () {
    return 'Hello world!!';
});

Route::resource('games', GameController::class);    
// Route::resource('category', CategoryController::class);
// Route::resource('users', UserController::class);


// Route::get('/games', 'App\Http\Controllers\GameController@index');
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);
Route::get('/games/category/{categoryID}', [GameController::class, 'getByCategory']);

Route::get('/users', [UserController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Route::get('sneakers/brand/{id}',[SneakersController::class,'getByBrand']);

// Route::get('sneakers/type/{id}',[SneakersController::class,'getByType']);


//  Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('/profile', function(Request $request) {
//         return auth()->user();
//     });

//     Route::get('my-sneakers',[SneakersController::class,'mySneakers']);

//     Route::get('/logout',[AuthController::class,'logout']);

//     Route::resource('sneakers',SneakersController::class)->only('store','update','destroy');

// });

