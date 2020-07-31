<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//RepublicController
Route::post('createRepublic', 'RepublicController@createRepublic');

Route::get('showRepublic/{id}', 'RepublicController@showRepublic');

Route::get('listRepublic', 'RepublicController@listRepublic');

Route::put('updateRepublic/{id}', 'RepublicController@updateRepublic');

Route::delete('deleteRepublic/{id}', 'RepublicController@deleteRepublic');

Route::put('addUser/{id}/{republic_id}', 'RepublicController@addUser');

Route::put('removeUser/{republic_id}', 'RepublicController@removeUser');

Route::get('getRepublicByName/{name}', 'RepublicController@getRepublicByName');

Route::put('editRepublicByID/{republic_id}', 'RepublicController@editRepublicByID');

Route::put('retornarUsuarios/{id}', 'RepublicController@retornarUsuarios');

Route::put('showOwner/{id}', 'RepublicController@showOwner');

//User Controller
Route::get('showUser/{id}', 'UserController@showUser');

Route::post('createUser', 'UserController@createUser');

Route::delete('deleteUser/{id}', 'UserController@deleteUser');

Route::get('listUser', 'UserController@listUser');

Route::put('alugar/{user_id}/{republic_id}', 'UserController@alugar');

Route::put('retornarRepublica/{id}', 'UserController@retornarRepublica');

Route::get('listFavoritos/{id}', 'UserController@listFavoritos');

Route::put('favoritar/{id}/{republic_id}', 'UserController@favoritar');

Route::delete('desfavoritar/{id}/{republic_id}', 'UserController@desfavoritar');

Route::put('removeAluguel/{republic_id}/{user_id}', 'UserController@removeAluguel');

Route::get('listRepublic', 'RepublicController@listRepublic');

Route::post('register', 'API\PassportController@register');
Route::post('login', 'API\PassportController@login');

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('logout', 'API\PassportController@logout');
    Route::post('getDetails', 'API\PassportController@getDetails');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//CommentController
Route::post('createComment', 'CommentController@createComment');

Route::delete('deleteComment/{id}', 'CommentController@deleteComment');

//RoomController
Route::post('createRoom', 'RoomController@createRoom');

Route::delete('deleteRoom/{id}', 'RoomController@deleteRoom');
