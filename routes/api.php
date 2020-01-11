<?php

use Illuminate\Http\Request;

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

/*
* get all to-do lists
* get one to-do list
* create one to-do list (and create attachment)
* update one to-do list
* delete one to-do list
* delete all to-do list
*/
Route::get('/tasks', 'ToDoListController@getTasks');
Route::get('/tasks/{id}', 'ToDoListController@getTaskById');
Route::post('/tasks', 'ToDoListController@createTask');
Route::post('/tasks/attachment', 'ToDoListController@uploadAttachment');
Route::put('/tasks/{id}', 'ToDoListController@updateTaskById');
Route::delete('/tasks/{id}', 'ToDoListController@deleteTaskById');
Route::delete('/tasks', 'ToDoListController@deleteTasks');

/*
* generate a new token - use users credentials
*/
Route::post('/token', 'AuthController@generateToken');
Route::get('/token/refresh', 'AuthController@refreshToken');
