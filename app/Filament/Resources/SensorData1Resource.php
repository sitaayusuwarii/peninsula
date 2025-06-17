<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SensorData1Resource\Pages;
use App\Filament\Resources\SensorData1Resource\RelationManagers;
use App\Models\SensorData1;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SensorData1Resource extends Resource
{
    protected static ?string $model = SensorData1::class;

    protected static ?string $navigationIcon = 'heroicon-o-trash';
    protected static ?string $navigationGroup = 'Sensor Data';
    protected static ?string $navigationLabel = 'Tempat Sampah 1'; // Sidebar
    protected static ?string $modelLabel = 'Data Tempat Sampah 1'; // Form/Detail
    protected static ?string $pluralModelLabel = 'Tempat Sampah 1';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->label('ID'),

            Tables\Columns\TextColumn::make('virtual_lokasi')
                ->label('Lokasi')
                ->getStateUsing(fn () => 'Titik A')
                ->extraAttributes(['class' => 'filament-table-column']), // ⚠️ trik supaya muncul

            Tables\Columns\TextColumn::make('distance')->label('Jarak (cm)'),

            Tables\Columns\BadgeColumn::make('virtual_status')
                ->label('Status')
                ->getStateUsing(fn ($record) => $record->distance <= 20 ? 'Penuh' : 'Kosong')
                ->colors([
                    'danger' => fn ($state) => $state === 'Penuh',
                    'success' => fn ($state) => $state === 'Kosong',
                ])
                ->extraAttributes(['class' => 'filament-table-column']), // ⚠️ trik juga

            Tables\Columns\TextColumn::make('timestamp')
                ->label('Waktu')
                ->dateTime('d M Y H:i'),
        ])
        ->defaultSort('timestamp', 'desc');
}




    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSensorData1s::route('/'),
            'create' => Pages\CreateSensorData1::route('/create'),
            'edit' => Pages\EditSensorData1::route('/{record}/edit'),
        ];
    }
}
