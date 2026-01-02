<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 *
 */
class DeleteMarkedAndInactiveUsers extends Command
{
    /**
     * @var string
     */
    protected $signature = 'users:delete-marked-and-inactive';
    /**
     * @var string
     */
    protected $description = 'Usuwa użytkowników z remove=true lub bez aktywnej sesji. Loguje do pliku.';

    /**
     * @return int
     */
    public function handle()
    {
        $log = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/inactive-users-cleanup.log'),
        ]);

        if (config('session.driver') !== 'database') {
            $log->error('[' . now() . '] Błąd: Komenda wymaga drivera sesji "database".');
            $this->error('Komenda wymaga drivera sesji "database".');
            return 1;
        }

        $lifetimeSeconds = config('session.lifetime') * 60;

        $activeUserIds = DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', Carbon::now()->subSeconds($lifetimeSeconds)->timestamp)
            ->pluck('user_id')
            ->unique();

        $usersToDelete = User::where('temp_user_to_delete', true)
            ->orWhereNotIn('id', $activeUserIds->isEmpty() ? [0] : $activeUserIds)
            ->get();

        $count = $usersToDelete->count();

        if ($count === 0) {
            $log->info('[' . now() . '] Brak użytkowników do usunięcia.');
            return 0;
        }

        $deletedIds = $usersToDelete->pluck('id')->toArray();

        $usersToDelete->each->delete(); // soft delete – zmień na forceDelete() jeśli chcesz usuwać na stałe

        $logMessage = '[' . now() . '] Usunięto ' . $count . ' użytkowników. ID: ' . implode(', ', $deletedIds);
        $log->info($logMessage);

        $this->info("Usunięto {$count} użytkowników.");

        return 0;
    }
}
