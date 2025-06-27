<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log; // Tetap gunakan Log untuk debugging

class TelegramHelper
{
    public static function sendMessage(string $message, string $chatId): void
    {
        $token = config('services.telegram.bot_token');

        Log::info("TelegramHelper: Memulai pengiriman pesan menggunakan native cURL. Token tersedia: " . (!empty($token) ? 'Ya' : 'Tidak') . ", Chat ID: {$chatId}");

        if (empty($token) || empty($chatId)) {
            Log::warning("TelegramHelper: token atau chat_id kosong. Tidak dapat mengirim pesan.");
            return;
        }

        $telegramApiUrl = "https://api.telegram.org/bot{$token}/sendMessage";

        // --- MENGGUNAKAN NATIVE PHP cURL ---
        $ch = curl_init($telegramApiUrl);

        // Data yang akan dikirim dalam format JSON
        $postFields = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown', // Sesuaikan jika Anda menggunakan HTML
        ];

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Mengembalikan transfer sebagai string
        curl_setopt($ch, CURLOPT_POST, true);           // Mengatur permintaan sebagai POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields)); // Data POST dalam JSON

        // Mengatur header Content-Type agar server Telegram tahu kita mengirim JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        // --- SOLUSI SEMENTARA UNTUK cURL error 77 ---
        // JANGAN GUNAKAN INI DI PRODUKSI!
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // Jika Anda masih ingin mencoba menentukan cacert.pem, bisa pakai:
        // curl_setopt($ch, CURLOPT_CAINFO, 'C:\laragon\etc\ssl\cacert.pem');
        // Namun, jika masalah cURL 77 karena sertifikat, nonaktifkan dulu verifikasi
        // untuk memastikan alur kerja lainnya berfungsi.


        $response = curl_exec($ch); // Eksekusi permintaan cURL
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Dapatkan kode status HTTP
        $curlError = curl_error($ch); // Dapatkan pesan error cURL jika ada

        curl_close($ch); // Tutup sesi cURL

        if ($response === false) {
            Log::error('TelegramHelper: Gagal kirim ke Telegram (cURL error): ' . $curlError);
        } else {
            // Dekode respons JSON dari Telegram
            $responseData = json_decode($response, true);

            if ($httpCode >= 200 && $httpCode < 300 && isset($responseData['ok']) && $responseData['ok'] === true) {
                Log::info('TelegramHelper: Pesan Telegram berhasil dikirim (native cURL).', ['response_body' => $response]);
            } else {
                Log::error('TelegramHelper: Gagal kirim ke Telegram (native cURL).', [
                    'status_code' => $httpCode,
                    'response_body' => $response,
                    'error_message' => $curlError, // Tambahkan error cURL jika ada
                ]);
            }
        }
    }
}