# A RESTful API In Laravel

Build a RESTful-API ecosystem for to-do list with Laravel, PHP 7.2, Nginx, MySQL.

Also use JWT authentication. package: [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)

## Route List
| Method   | URI                  | Action                                                   | Middleware          |
|:---------|:---------------------|:---------------------------------------------------------|:--------------------|
| GET,HEAD | /                    | Closure                                                  | web                 |
| GET,HEAD | api/tasks            | App\Http\Controllers\ToDoListController@getTasks         | api                 |
| POST     | api/tasks            | App\Http\Controllers\ToDoListController@createTask       | api,custom.jwt.auth |
| DELETE   | api/tasks            | App\Http\Controllers\ToDoListController@deleteTasks      | api,custom.jwt.auth |
| POST     | api/tasks/attachment | App\Http\Controllers\ToDoListController@uploadAttachment | api,custom.jwt.auth |
| GET,HEAD | api/tasks/{id}       | App\Http\Controllers\ToDoListController@getTaskById      | api                 |
| PUT      | api/tasks/{id}       | App\Http\Controllers\ToDoListController@updateTaskById   | api,custom.jwt.auth |
| DELETE   | api/tasks/{id}       | App\Http\Controllers\ToDoListController@deleteTaskById   | api,custom.jwt.auth |
| POST     | api/token            | App\Http\Controllers\AuthController@generateToken        | api                 |
| GET,HEAD | api/token/refresh    | App\Http\Controllers\AuthController@refreshToken         | api                 |
