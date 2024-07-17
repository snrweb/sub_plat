<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Commented this out since auth is not required for this test
//
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('posts', [PostController::class, 'store']);
Route::post('subscriptions', [SubscriptionController::class, 'store']);
