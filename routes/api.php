<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\TelegramHelper; // Pastikan ini di-import
use App\Models\TelegramUser; // Pastikan ini di-import
use Illuminate\Support\Facades\Log; // Pastikan ini di-import
// use Illuminate\Support\Facades\Http; // Ini tidak lagi diperlukan di sini karena kita menggunakan TelegramHelper

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

// Route untuk menerima data sensor
Route::get('/receive-data/1', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data1', 'Tempat Sampah 1', 'Titik A')
);

Route::get('/receive-data/2', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data2', 'Tempat Sampah 2', 'Titik B')
);

Route::get('/receive-data/3', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data3', 'Tempat Sampah 3', 'Titik C')
);

Route::get('/receive-data/4', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data4', 'Tempat Sampah 4', 'Titik D')
);

Route::get('/receive-data/5', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data5', 'Tempat Sampah 5', 'Titik E')
);

Route::get('/receive-data/6', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data6', 'Tempat Sampah 6', 'Titik F')
);

Route::get('/receive-data/7', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data7', 'Tempat Sampah 7', 'Titik G')
);

Route::get('/receive-data/8', fn(Request $request) =>
    insertToSensorTable($request, 'sensor_data8', 'Tempat Sampah 8', 'Titik H')
);

// Route untuk webhook Telegram
Route::post('/telegram/webhook', function (Request $request) {
    Log::info('Webhook Telegram diterima di rute API.'); // LOG 1
    // Mengambil payload JSON dari Telegram
    $update = $request->json()->all();

    if (empty($update)) {
        Log::warning('Webhook Telegram: Payload kosong atau tidak valid.'); // LOG 2
        return response()->json(['ok' => false, 'message' => 'Payload kosong'], 400);
    }

    $chatId = $update['message']['chat']['id'] ?? null;
    $text = $update['message']['text'] ?? '';

    if (empty($chatId)) {
        Log::warning('Webhook Telegram: chat_id tidak ditemukan di payload.', ['update' => $update]); // LOG 3
        return response()->json(['ok' => false, 'message' => 'chat_id tidak ada'], 400);
    }

    Log::info("Webhook Telegram: Pesan dari chat_id {$chatId}, teks: '{$text}'"); // LOG 4

    // Logika untuk command /start
    if (strtolower($text) === '/start') {
        TelegramUser::updateOrCreate([
            'chat_id' => $chatId,
        ]);
        Log::info("Webhook Telegram: Pengguna {$chatId} terdaftar/diperbarui."); // LOG 5

        // Menggunakan TelegramHelper untuk mengirim pesan konfirmasi
        TelegramHelper::sendMessage(
            '✅ Kamu sudah terdaftar untuk menerima notifikasi tong sampah!',
            $chatId
        );
        Log::info("Webhook Telegram: Mencoba mengirim pesan konfirmasi ke {$chatId} melalui Helper."); // LOG 6
    }
    // Logika untuk command /status (Contoh tambahan jika Anda ingin fitur ini)
    else if (strtolower($text) === '/status') {
        // Ambil data sensor terbaru dari salah satu tong sampah, contohnya sensor_data1
        $latestSensorData = DB::table('sensor_data1')->latest('timestamp')->first();

        if ($latestSensorData) {
            $distance = $latestSensorData->distance;
            $tinggiTong = 100; // Asumsi tinggi tong sampah
            $persentaseIsi = (100 - $distance) / $tinggiTong * 100; // Pembagian dengan $tinggiTong

            $statusTong = 'Kosong';
            if ($persentaseIsi >= 80) {
                $statusTong = 'Penuh';
            } elseif ($persentaseIsi >= 50) {
                $statusTong = 'Sedang';
            }

            $message = "Status Tempat Sampah 1 saat ini:\n";
            $message .= "📏 Jarak: {$distance} cm\n";
            $message .= "📊 Isi: " . round($persentaseIsi) . "%\n";
            $message .= "⚠️ Status: *{$statusTong}*";

            TelegramHelper::sendMessage($message, $chatId);
            Log::info("Webhook Telegram: Mengirim status tong sampah ke {$chatId}.");
        } else {
            TelegramHelper::sendMessage("Maaf, data sensor Tempat Sampah 1 belum tersedia.", $chatId);
            Log::info("Webhook Telegram: Data sensor tidak tersedia, memberitahu {$chatId}.");
        }
    }
    // Respon default untuk pesan selain /start atau /status
    else {
        Log::info("Webhook Telegram: Pesan bukan /start atau /status. Mengirim pesan tidak dikenal ke {$chatId}."); // LOG 7
        TelegramHelper::sendMessage(
            "Maaf, saya tidak mengerti perintah itu. Ketik /start untuk mendaftar notifikasi, atau /status untuk cek status tong sampah.",
            $chatId
        );
    }

    return response()->json(['ok' => true]);
});

// Fungsi pembantu untuk insert data sensor dan mengirim notifikasi
if (!function_exists('insertToSensorTable')) {
    function insertToSensorTable(Request $request, $table, $label, $location)
    {
        $distance = $request->query('distance');
        Log::info("receive-data: Menerima data untuk {$label} ({$table}), distance: {$distance}."); // LOG 8

        if (!$distance || !is_numeric($distance)) {
            Log::warning("receive-data: Parameter distance tidak valid untuk {$label}.", ['request' => $request->all()]); // LOG 9
            return response()->json([
                'status' => 'error',
                'message' => "Parameter distance harus ada dan berupa angka untuk $label."
            ], 400);
        }

        $tinggiTong = 100; // cm - Pastikan ini sesuai dengan tinggi fisik tong sampah Anda
        $persentaseIsi = (100 - $distance) / $tinggiTong * 100;
        $status = $persentaseIsi >= 80 ? 'Penuh' : 'Kosong'; // Kustomisasi logika status Anda jika diperlukan
        Log::info("receive-data: Persentase isi {$label}: " . round($persentaseIsi) . "%, status: {$status}."); // LOG 10

        try {
            DB::table($table)->insert([
                'distance' => $distance,
                'timestamp' => now(),
            ]);
            Log::info("receive-data: Data berhasil disimpan ke {$table}.", ['distance' => $distance]); // LOG 11

            // Kirim notifikasi jika penuh
            if ($status === 'Penuh') {
                $chatIds = TelegramUser::pluck('chat_id');
                if ($chatIds->isEmpty()) {
                    Log::warning("receive-data: Tidak ada TelegramUser yang terdaftar untuk menerima notifikasi."); // LOG 12
                } else {
                    Log::info("receive-data: Mengirim notifikasi penuh ke " . $chatIds->count() . " pengguna."); // LOG 13
                    foreach ($chatIds as $chatId) {
                        TelegramHelper::sendMessage(
                            "🚨 *$label* PENUH!\n📍 Lokasi: $location\n📏 Jarak: {$distance} cm\n📊 Isi: " . round($persentaseIsi) . "%\n⚠️ Segera kosongkan tempat sampah!",
                            $chatId
                        );
                    }
                }
            } else {
                Log::info("receive-data: Status tidak Penuh, tidak mengirim notifikasi."); // LOG 14
            }

            return response()->json([
                'status' => 'success',
                'message' => "Data berhasil disimpan ke $label ($table).",
                'status_tong' => $status,
                'isi' => round($persentaseIsi, 1) . '%'
            ]);
        } catch (\Exception $e) {
            Log::error('receive-data: Gagal menyimpan data atau mengirim notifikasi:', [ // LOG 15
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'status' => 'error',
                'message' => "Gagal menyimpan data ke $label: " . $e->getMessage()
            ], 500);
        }
    }
}