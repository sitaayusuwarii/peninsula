<?php

namespace App\Filament\Resources\SensorData1Resource\Pages;

use App\Filament\Resources\SensorData1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\SensorReset;
use App\Models\SensorData1;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;

class ListSensorData1s extends ListRecords
{
    protected static string $resource = SensorData1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
             Actions\Action::make('Reset Data')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function () {
                SensorReset::updateOrCreate(
                    ['sensor_name' => 'sensor_data1'],
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
        $resetAt = optional(SensorReset::where('sensor_name', 'sensor_data1')->first())->reset_at;

        $query = SensorData1::query();

        if ($resetAt) {
            $query->where('timestamp', '>=', $resetAt);
        }

        return $query;
    }
}
