<?php

namespace App\Filament\Widgets;

use App\Models\SensorData1;
use App\Models\SensorData2;
use App\Models\SensorData3;
use App\Models\SensorData4;
use App\Models\SensorData5;
use App\Models\SensorData6;
use App\Models\SensorData7;
use App\Models\SensorData8;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

use Filament\Widgets\BarChartWidget;
use Illuminate\Contracts\View\View;
use Filament\Widgets\Widget;

class GrafikSemuaSensor extends BarChartWidget
{
    protected static ?string $heading = 'Grafik Persentase Isi Tong Sampah (%)';
    protected static ?int $sort = 1;
    protected $listeners = ['refreshChart' => '$refresh'];


    public function getHeaderActions(): array
{
     return [
        Action::make('Reset Tampilan')
            ->label('Reset Tampilan')
            ->icon('heroicon-o-arrow-path')
            ->color('secondary')
            ->action(function () {
                $this->dispatch('refreshChart'); // trigger refresh grafik

                Notification::make()
                    ->title('Tampilan berhasil direset!')
                    ->success()
                    ->send();
            }),
    ];
}

    // Lebar full
    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    public function getContentHeight(): ?string
    {
    return '500px'; // atau '600px', bebas kamu sesuaikan
    }

    public function getPollingInterval(): ?string
    {
        return '5s'; // atau '10s', '30s', dst
    }

    
    // Opsi tampilan grafik
    protected function getOptions(): array
    {
        return [
            'animation' => [
                'duration' => 1000,
                'easing' => 'easeOutBounce',
            ],
            'maintainAspectRatio' => true,
            'scales' => [
                'y' => [
                    'min' => 0,
                    'max' => 100,
                    'ticks' => ['stepSize' => 10],
                ],
            ],
        ];
    }

    // Data yang ditampilkan
    protected function getData(): array
    {
        $tinggiTong = 100;

        $sensor1 = SensorData1::latest('timestamp')->first();
        $sensor2 = SensorData2::latest('timestamp')->first();
        $sensor3 = SensorData3::latest('timestamp')->first();
        $sensor4 = SensorData4::latest('timestamp')->first();
        $sensor5 = SensorData5::latest('timestamp')->first();
        $sensor6 = SensorData6::latest('timestamp')->first();
        $sensor7 = SensorData7::latest('timestamp')->first();
        $sensor8 = SensorData8::latest('timestamp')->first();


        // Ambil jarak atau default ke tinggi penuh
        $jarak = [
            $sensor1?->distance ?? $tinggiTong,
            $sensor2?->distance ?? $tinggiTong,
            $sensor3?->distance ?? $tinggiTong,
            $sensor4?->distance ?? $tinggiTong,
            $sensor5?->distance ?? $tinggiTong,
            $sensor6?->distance ?? $tinggiTong,
            $sensor7?->distance ?? $tinggiTong,
            $sensor8?->distance ?? $tinggiTong,

        ];

        // Hitung persentase isi tong
        $persentase = collect($jarak)->map(fn($d) => max(0, min(100, round((($tinggiTong - $d) / $tinggiTong) * 100))))->toArray();

        // Tentukan status
        $status = collect($jarak)->map(fn($d) => $d <= 20 ? 'Penuh' : 'Kosong')->toArray();

        // Warna batang: merah jika penuh
        $colors = [
            $jarak[0] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(54, 162, 235, 0.8)',
            $jarak[1] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(255, 206, 86, 0.8)',
            $jarak[2] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(153, 102, 255, 0.8)',
            $jarak[3] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(31, 216, 71, 0.8)',
            $jarak[4] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(223, 53, 180, 0.8)',
            $jarak[5] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(172, 212, 59, 0.8)',
            $jarak[6] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(27, 10, 122, 0.8)',
            $jarak[7] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(198, 218, 180, 0.8)',

        ];

        $borderColors = [
            $jarak[0] <= 20 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)',
            $jarak[1] <= 20 ? 'rgba(255, 99, 132, 1)' : 'rgba(255, 206, 86, 1)',
            $jarak[2] <= 20 ? 'rgba(255, 99, 132, 1)' : 'rgba(153, 102, 255, 1)',
            $jarak[3] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(31, 216, 71, 0.8)',
            $jarak[4] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(223, 53, 180, 0.8)',
            $jarak[5] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(172, 212, 59, 0.8)',
            $jarak[6] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(27, 10, 122, 0.8)',
            $jarak[7] <= 20 ? 'rgba(248, 7, 7, 0.8)' : 'rgba(198, 218, 180, 0.8)',
        ];

        // Label batang
        $labels = [
            "Tong 1 ({$status[0]} - {$persentase[0]}%)",
            "Tong 2 ({$status[1]} - {$persentase[1]}%)",
            "Tong 3 ({$status[2]} - {$persentase[2]}%)",
            "Tong 4 ({$status[3]} - {$persentase[3]}%)",
            "Tong 5 ({$status[4]} - {$persentase[4]}%)",
            "Tong 6 ({$status[5]} - {$persentase[5]}%)",
            "Tong 7 ({$status[6]} - {$persentase[6]}%)",
            "Tong 8 ({$status[7]} - {$persentase[7]}%)",

        ];

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Persentase Isi Tong (%)',
                    'data' => $persentase,
                    'backgroundColor' => $colors,
                    'borderColor' => $borderColors,
                    // 'borderWidth' => 1,
                ],
            ],
        ];
    }

//     protected function getView(): string
//     {
//         return 'filament.widgets.grafik-semua-sensor'; // buat file Blade dengan nama ini
//     }

}
