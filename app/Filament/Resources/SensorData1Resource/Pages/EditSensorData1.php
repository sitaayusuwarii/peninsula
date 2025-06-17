<?php

namespace App\Filament\Resources\SensorData1Resource\Pages;

use App\Filament\Resources\SensorData1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData1 extends EditRecord
{
    protected static string $resource = SensorData1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
