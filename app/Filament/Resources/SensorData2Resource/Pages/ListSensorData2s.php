<?php

namespace App\Filament\Resources\SensorData2Resource\Pages;

use App\Filament\Resources\SensorData2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\SensorReset;
use App\Models\SensorData2;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification; // ← ini penting

class ListSensorData2s extends ListRecords
{
    protected static string $resource = SensorData2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
             Actions\Action::make('Reset Data')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function () {
                SensorReset::updateOrCreate(
                    ['sensor_name' => 'sensor_data2'],
                    ['reset_at' => now()]
                );

                Notification::make()
                    ->title('Tampilan data berhasil direset.')
                    ->success()
                    ->send();
            }),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $resetAt = optional(SensorReset::where('sensor_name', 'sensor_data2')->first())->reset_at;

        $query = SensorData2::query();

        if ($resetAt) {
            $query->where('timestamp', '>=', $resetAt);
        }

        return $query;
    }
}
