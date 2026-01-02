<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
// Usuwanie użytkowników codziennie o północy
Schedule::command('users:delete-marked-and-inactive')->daily();

// Czyszczenie sesji co godzinę
Schedule::command('sessions:prune-expired')->everyThreeHours();
