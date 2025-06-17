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
use App\Models\SensorReset;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Widgets\BarChartWidget;

class GrafikSemuaSensor extends BarChartWidget
{
    protected static ?string $heading = 'Grafik Persentase Isi Tempat Sampah (%)';
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
                    foreach (range(1, 8) as $i) {
                        SensorReset::updateOrCreate(
                            ['sensor_name' => 'sensor_data' . $i],
                            ['reset_at' => now()]
                        );
                    }

                    $this->dispatch('refreshChart');

                    Notification::make()
                        ->title('Tampilan semua sensor berhasil direset!')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    public function getContentHeight(): ?string
    {
        return '500px';
    }

    public function getPollingInterval(): ?string
    {
        return '5s';
    }

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

    protected function getData(): array
    {
        $tinggiTong = 100;

        // Ambil waktu reset tiap sensor
        $resetTimes = collect(range(1, 8))->mapWithKeys(function ($i) {
            $reset = SensorReset::where('sensor_name', 'sensor_data' . $i)->first();
            return ['sensor' . $i => optional($reset)->reset_at];
        });

        // Ambil data terbaru dari masing-masing sensor
        $sensorModels = [
            SensorData1::class,
            SensorData2::class,
            SensorData3::class,
            SensorData4::class,
            SensorData5::class,
            SensorData6::class,
            SensorData7::class,
            SensorData8::class,
        ];

        $dataSensors = collect($sensorModels)->map(function ($model, $index) use ($resetTimes) {
            $resetKey = 'sensor' . ($index + 1);
            return $model::when($resetTimes[$resetKey], fn($q) => $q->where('timestamp', '>=', $resetTimes[$resetKey]))
                ->latest('timestamp')->first();
        });

        // Hitung jarak, persentase isi, dan status
        $jarak = $dataSensors->map(fn($sensor) => $sensor?->distance ?? $tinggiTong)->toArray();
        $persentase = collect($jarak)->map(fn($d) => max(0, min(100, round((($tinggiTong - $d) / $tinggiTong) * 100))))->toArray();
        $status = collect($jarak)->map(fn($d) => $d <= 20 ? 'Penuh' : 'Kosong')->toArray();

        // Warna tetap untuk tiap tong
        $warnaTetap = [
            'rgba(54, 162, 235, 0.8)',   // Tong 1 - biru
            'rgba(255, 206, 86, 0.8)',   // Tong 2 - kuning
            'rgba(75, 192, 192, 0.8)',   // Tong 3 - hijau laut
            'rgba(153, 102, 255, 0.8)',  // Tong 4 - ungu
            'rgba(255, 159, 64, 0.8)',   // Tong 5 - oranye
            'rgba(199, 199, 199, 0.8)',  // Tong 6 - abu-abu
            'rgba(255, 99, 132, 0.8)',   // Tong 7 - pink
            'rgba(100, 255, 218, 0.8)',  // Tong 8 - toska
        ];

        $warnaBorderTetap = [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(199, 199, 199, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(100, 255, 218, 1)',
        ];

        // Ubah warna jika penuh
        $colors = collect($jarak)->map(function ($d, $i) use ($warnaTetap) {
            return $d <= 20 ? 'rgba(248, 7, 7, 0.8)' : $warnaTetap[$i];
        })->toArray();

        $borderColors = collect($jarak)->map(function ($d, $i) use ($warnaBorderTetap) {
            return $d <= 20 ? 'rgba(255, 0, 0, 1)' : $warnaBorderTetap[$i];
        })->toArray();

        // Label batang
        $labels = collect(range(1, 8))->map(fn($i) => "Tong $i ({$status[$i - 1]} - {$persentase[$i - 1]}%)")->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Persentase Isi Tong (%)',
                    'data' => $persentase,
                    'backgroundColor' => $colors,
                    'borderColor' => $borderColors,
                ],
            ],
        ];
    }
}
