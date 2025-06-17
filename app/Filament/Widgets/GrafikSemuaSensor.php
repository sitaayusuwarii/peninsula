<?php

namespace App\Filament\Widgets;

use App\Models\SensorData1;
use App\Models\SensorData2;
use App\Models\SensorData3;
use Filament\Widgets\BarChartWidget;
use Illuminate\Contracts\View\View;
use Filament\Widgets\Widget;

class GrafikSemuaSensor extends BarChartWidget
{
    protected static ?string $heading = 'Grafik Persentase Isi Tong Sampah (%)';
    protected static ?int $sort = 1;

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
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'min' => 0,
                    'max' => 100,
                    'ticks' => ['stepSize' => 5],
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

        // Ambil jarak atau default ke tinggi penuh
        $jarak = [
            $sensor1?->distance ?? $tinggiTong,
            $sensor2?->distance ?? $tinggiTong,
            $sensor3?->distance ?? $tinggiTong,
        ];

        // Hitung persentase isi tong
        $persentase = collect($jarak)->map(fn($d) => max(0, min(100, round((($tinggiTong - $d) / $tinggiTong) * 100))))->toArray();

        // Tentukan status
        $status = collect($jarak)->map(fn($d) => $d <= 20 ? 'Penuh' : 'Kosong')->toArray();

        // Warna batang: merah jika penuh
        $colors = [
            $jarak[0] <= 20 ? 'rgba(255, 99, 132, 0.8)' : 'rgba(54, 162, 235, 0.8)',
            $jarak[1] <= 20 ? 'rgba(255, 99, 132, 0.8)' : 'rgba(255, 206, 86, 0.8)',
            $jarak[2] <= 20 ? 'rgba(255, 99, 132, 0.8)' : 'rgba(153, 102, 255, 0.8)',
        ];

        $borderColors = [
            $jarak[0] <= 20 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)',
            $jarak[1] <= 20 ? 'rgba(255, 99, 132, 1)' : 'rgba(255, 206, 86, 1)',
            $jarak[2] <= 20 ? 'rgba(255, 99, 132, 1)' : 'rgba(153, 102, 255, 1)',
        ];

        // Label batang
        $labels = [
            "Tong 1 ({$status[0]} - {$persentase[0]}%)",
            "Tong 2 ({$status[1]} - {$persentase[1]}%)",
            "Tong 3 ({$status[2]} - {$persentase[2]}%)",
        ];

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Persentase Isi Tong (%)',
                    'data' => $persentase,
                    'backgroundColor' => $colors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getView(): string
    {
        return 'filament.widgets.grafik-semua-sensor'; // buat file Blade dengan nama ini
    }

}
