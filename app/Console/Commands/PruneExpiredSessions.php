<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 *
 */
class PruneExpiredSessions extends Command
{
    /**
     * @var string
     */
    protected $signature = 'sessions:prune-expired';
    /**
     * @var string
     */
    protected $description = 'Usuwa wygasłe rekordy sesji z bazy. Loguje do pliku.';

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
            $log->error('[' . now() . '] Błąd: Czyszczenie sesji działa tylko z driverem "database".');
            $this->error('Driver sesji nie jest "database".');
            return 1;
        }

        $lifetimeSeconds = config('session.lifetime') * 60;

        $deleted = DB::table('sessions')
            ->where('last_activity', '<', Carbon::now()->subSeconds($lifetimeSeconds)->timestamp)
            ->delete();

        $logMessage = '[' . now() . '] Wyczyszczono ' . $deleted . ' wygasłych rekordów sesji.';
        $log->info($logMessage);

        $this->info("Wyczyszczono {$deleted} wygasłych sesji.");

        return 0;
    }
}
