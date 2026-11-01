<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationLabel = 'Website Color';

    protected static ?string $navigationGroup = 'Website';

    public static function form(Form $form): Form
{
    return $form
        ->schema([

            Forms\Components\Hidden::make('school_id')
                ->default(auth()->user()->school_id),

            Forms\Components\Select::make('key')
                ->options([
                    'primary_color' => 'Primary Color',
                    'secondary_color' => 'Secondary Color',
                    'navbar_color' => 'Navbar Color',
                    'footer_color' => 'Footer Color',
                ])
                ->required(),

            Forms\Components\ColorPicker::make('value')
                ->required(),

        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('key')
                ->label('Setting'),

            Tables\Columns\ColorColumn::make('value')
                ->label('Warna'),
        ]);
}

   public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('school_id', auth()->user()->school_id);
}
public static function getPages(): array
{
    return [
        'index' => Pages\ListSettings::route('/'),
        'create' => Pages\CreateSetting::route('/create'),
        'edit' => Pages\EditSetting::route('/{record}/edit'),
    ];
}
}