<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramHelper
{
    public static function sendMessage(string $message, string $chatId): void
    {
        $token = config('services.telegram.bot_token');

        if (empty($token) || empty($chatId)) {
            Log::warning("TelegramHelper: token atau chat_id kosong.");
            return;
        }

        $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown',
        ]);

        if ($response->failed()) {
            Log::error('Gagal kirim ke Telegram: ' . $response->body());
        }
    }
}
