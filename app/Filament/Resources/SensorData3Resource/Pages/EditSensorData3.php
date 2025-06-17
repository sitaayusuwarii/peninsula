<?php

namespace App\Filament\Resources\SensorData3Resource\Pages;

use App\Filament\Resources\SensorData3Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData3 extends EditRecord
{
    protected static string $resource = SensorData3Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
