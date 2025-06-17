<?php

namespace App\Filament\Resources\SensorData4Resource\Pages;

use App\Filament\Resources\SensorData4Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\SensorReset;
use App\Models\SensorData4;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;

class ListSensorData4s extends ListRecords
{
    protected static string $resource = SensorData4Resource::class;

    protected function getHeaderActions(): array
    {
        return [
             Actions\Action::make('Reset Data')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function () {
                SensorReset::updateOrCreate(
                    ['sensor_name' => 'sensor_data4'],
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
        $resetAt = optional(SensorReset::where('sensor_name', 'sensor_data4')->first())->reset_at;

        $query = SensorData4::query();

        if ($resetAt) {
            $query->where('timestamp', '>=', $resetAt);
        }

        return $query;
    }
}
