<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\TelegramHelper;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Http;


Route::get('/receive-data/1', function (Request $request) {
    return insertToSensorTable($request, 'sensor_data1', 'Tempat Sampah 1');
});

Route::get('/receive-data/2', function (Request $request) {
    return insertToSensorTable($request, 'sensor_data2', 'Tempat Sampah 2');
});

Route::get('/receive-data/3', function (Request $request) {
    return insertToSensorTable($request, 'sensor_data3', 'Tempat Sampah 3');
});

Route::post('/telegram/webhook', function () {
    $update = json_decode(file_get_contents('php://input'), true);

    if (isset($update['message']['text']) && $update['message']['text'] === '/start') {
        $chatId = $update['message']['chat']['id'];

        TelegramUser::updateOrCreate([
            'chat_id' => $chatId,
        ]);

        Http::post("https://api.telegram.org/bot" . config('services.telegram.bot_token') . "/sendMessage", [
    'chat_id' => $chatId,
    'text' => '✅ Kamu sudah terdaftar untuk menerima notifikasi tong sampah!',
    ]);

    }

    return response()->json(['ok' => true]);
});


if (!function_exists('insertToSensorTable')) {
    function insertToSensorTable(Request $request, $table, $label)
    {
        $distance = $request->query('distance');
        $location = $request->query('location', $label); // fallback pakai label sensor

        if (!$distance || !is_numeric($distance)) {
            return response()->json([
                'status' => 'error',
                'message' => "Parameter distance harus ada dan berupa angka untuk $label."
            ], 400);
        }

        $tinggiTong = 100; // cm
        $persentaseIsi = (100 - $distance) / 100 * 100;
        $status = $persentaseIsi >= 80 ? 'Penuh' : 'Kosong';

        try {
            DB::table($table)->insert([
                'distance' => $distance,
                'timestamp' => now(),
            ]);

            // Kirim notifikasi jika penuh
          if ($status === 'Penuh') {
    $chatIds = \App\Models\TelegramUser::pluck('chat_id');
    foreach ($chatIds as $chatId) {
        TelegramHelper::sendMessage(
            "🚨 *$label* PENUH!\n📍 Jarak: {$distance} cm\n📊 Isi: " . round($persentaseIsi) . "%\n⚠️ Segera kosongkan tempat sampah!",
            $chatId
        );
    }
}


            return response()->json([
                'status' => 'success',
                'message' => "Data berhasil disimpan ke $label ($table).",
                'status_tong' => $status,
                'isi' => round($persentaseIsi, 1) . '%'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Gagal menyimpan data ke $label: " . $e->getMessage()
            ], 500);
        }
    }
}
