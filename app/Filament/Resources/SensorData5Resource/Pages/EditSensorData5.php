<?php

namespace App\Filament\Resources\SensorData5Resource\Pages;

use App\Filament\Resources\SensorData5Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData5 extends EditRecord
{
    protected static string $resource = SensorData5Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
