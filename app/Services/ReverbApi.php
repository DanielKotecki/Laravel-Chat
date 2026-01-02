<?php
declare(strict_types=1);
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReverbApi
{
    public function getOnlineUsers(string $channelName): array
    {
        $appId = config('broadcasting.connections.reverb.app_id');
        $host = config('broadcasting.connections.reverb.host', '127.0.0.1');
        $port = config('broadcasting.connections.reverb.port', 8080);
        $scheme = config('broadcasting.connections.reverb.scheme', 'http');
        $appKey = config('broadcasting.connections.reverb.key'); // Wymagane jako hasło w Basic Auth

        $url = "{$scheme}://{$host}:{$port}/apps/{$appId}/channels/{$channelName}/users";

        try {
            $response = Http::timeout(5)
                ->withBasicAuth($appId, $appKey)
                ->get($url);

            if ($response->successful()) {
                $data = $response->json();

                return collect($data['users'] ?? [])
                    ->pluck('info')
                    ->toArray();
            }

            Log::warning('Reverb API zwróciło błąd HTTP', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

        } catch (\Exception $e) {
            Log::warning('Reverb API nieosiągalne lub błąd połączenia', ['error' => $e->getMessage()]);
        }

        return [];
    }
}
