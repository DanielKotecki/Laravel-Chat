<?php

use App\Http\Controllers\ReverbWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/reverb-webhook', [ReverbWebhookController::class, 'handle']);
// Webhooki z Pushera/Reverb nie wymagają weryfikacji CSRF
