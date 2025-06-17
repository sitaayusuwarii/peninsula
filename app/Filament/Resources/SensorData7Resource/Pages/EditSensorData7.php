<?php

namespace App\Filament\Resources\SensorData7Resource\Pages;

use App\Filament\Resources\SensorData7Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData7 extends EditRecord
{
    protected static string $resource = SensorData7Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
