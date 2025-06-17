<?php

namespace App\Filament\Resources\SensorData2Resource\Pages;

use App\Filament\Resources\SensorData2Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData2 extends EditRecord
{
    protected static string $resource = SensorData2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
