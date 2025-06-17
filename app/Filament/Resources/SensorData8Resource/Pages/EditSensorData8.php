<?php

namespace App\Filament\Resources\SensorData8Resource\Pages;

use App\Filament\Resources\SensorData8Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData8 extends EditRecord
{
    protected static string $resource = SensorData8Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
