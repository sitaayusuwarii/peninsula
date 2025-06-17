<?php

namespace App\Filament\Resources\SensorData6Resource\Pages;

use App\Filament\Resources\SensorData6Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSensorData6 extends EditRecord
{
    protected static string $resource = SensorData6Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
