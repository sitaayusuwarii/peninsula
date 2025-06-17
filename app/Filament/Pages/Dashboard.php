<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\GrafikSemuaSensor;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    public function getHeaderWidgets(): array
    {
        return [
            GrafikSemuaSensor::class,
        ];
    }
}
