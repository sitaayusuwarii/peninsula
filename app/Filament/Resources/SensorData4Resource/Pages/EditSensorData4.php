<?php

namespace App\Filament\Resources\SensorData4Resource\Pages;

use App\Filament\Resources\SensorData4Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData4 extends EditRecord
{
    protected static string $resource = SensorData4Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
