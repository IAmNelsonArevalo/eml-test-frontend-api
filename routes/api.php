<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{StatusesController, AuthController, UsersController};

Route::prefix("statuses")->group(function(){
   Route::post("create", array(StatusesController::class, "createStatus"));
   Route::put("update", array(StatusesController::class, "editStatus"));
   Route::get("get-statuses", array(StatusesController::class, "getStatuses"));
   Route::delete("delete-status/{id}", array(StatusesController::class, "deleteStatus"));
});

Route::prefix("auth")->group(function() {
    Route::post("login", array(AuthController::class, "login"));
    Route::post("register", array(AuthController::class, "register"));
    Route::get("get-document-types", array(AuthController::class, "getDocumentTypes"));
    Route::put("password-recovery", array(AuthController::class, "passwordRecovery"));
});

Route::prefix("users")->group(function() {
    Route::get("get-users", array(UsersController::class, "getUsers"));
    Route::put("change-status/{id}", array(UsersController::class, "changeStatus"));
    Route::put("update-user", array(UsersController::class, "updateUser"));
    Route::delete("delete-user/{id}", array(UsersController::class, "deleteUser"));
});

