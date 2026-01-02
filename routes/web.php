<?php

use App\Http\Controllers\Auth\LogoutUserController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Chat\PageChat;
use App\Livewire\StartChatForm;
use App\Livewire\TermsPage;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//AUTH VIEW DISABLED
//require __DIR__ . '/auth.php';

Route::get('/', StartChatForm::class)->name('start-chat-form');
Route::get('/chat', PageChat::class)->name('chat')->middleware('auth.chat');
Route::get('/locale/{lang}', [LocaleController::class, 'setLocale'])
    ->whereIn('lang', ['pl', 'en', 'de', 'fr'])
    ->name('locale.set');
Route::post('/logout', [LogoutUserController::class, 'logout'])->name('logout');
Route::get('/terms', TermsPage::class)->name('terms');
