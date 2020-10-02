<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmployeersController;
use App\Http\Controllers\Auth\EquipamentsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'cors'], function(){
    #Auth
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/delete', [AuthController::class, 'delete']);
    
    
    #Employeers
    Route::post('/addEmployeer', [EmployeersController::class, 'addEmployeer']);
    Route::post('/editEmployeer', [EmployeersController::class, 'editEmployeer']);
    Route::post('/removeEmployeer', [EmployeersController::class, 'removeEmployeer']);
    

    #Equipaments
    Route::post('/addEquipament', [EquipamentsController::class, 'addEquipament']);
    Route::post('/editEquipament', [EquipamentsController::class, 'editEquipament']);
    Route::post('/removeEquipament', [EquipamentsController::class, 'removeEquipament']);

});
