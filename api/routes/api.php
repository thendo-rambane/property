<?php

use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PotentialUserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SectionalsController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserProfileController;
use App\Http\Resources\AgentResource;
use App\Http\Resources\UserProfileResource;
use App\Models\PotentialUser;
use App\Models\UserProfile;
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

Route::post('/sanctum/token', TokenController::class);

Route::post('/profiles/new', [PotentialUserController::class, 'store'])->middleware('auth:sanctum');
Route::get('/profiles/new', function () {
  return PotentialUser::all();
})->middleware('auth:sanctum');

Route::post('/property/features/new', [FeaturesController::class, 'store'])->middleware('auth:sanctum');
Route::get('/property/features', [FeaturesController::class, 'index'])->middleware('auth:sanctum');
Route::get('/agents', function () {
  return AgentResource::collection(UserProfile::all()->where('is_agent', true));
})->middleware('auth:sanctum');

Route::post('/sanctum/token', TokenController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return new UserProfileResource($request->user()->profile);
});

Route::apiResource('profiles', UserProfileController::class)->middleware('auth:sanctum');

Route::apiResource(
  'properties',
  PropertyController::class
);
Route::apiResource(
  'messages',
  MessageController::class
);

Route::apiResource(
  'sectionals',
  SectionalsController::class
);
