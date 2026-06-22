<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Menu Navigation bar';

    protected static ?string $navigationGroup = 'Website';

    public static function form(Form $form): Form
{
    return $form
        ->schema([

            Forms\Components\Hidden::make('school_id')
                ->default(auth()->user()->school_id),

            Forms\Components\Select::make('name')
                ->label('Pilih Menu')
                ->options([
                    'Beranda' => 'Beranda',
                    'Berita' => 'Berita',
                    'Guru' => 'Guru',
                    'Galeri' => 'Galeri',
                    'Fasilitas' => 'Fasilitas',
                    'Ekstrakurikuler' => 'Ekstrakurikuler',
                    'PPDB' => 'PPDB',
                ])
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {

                 $slugs = [
                    'Beranda' => '/',
                    'Berita' => 'berita',
                    'Guru' => 'guru',
                    'Galeri' => 'galeri',
                    'Fasilitas' => 'fasilitas',
                    'Ekstrakurikuler' => 'ekstrakurikuler',
                    'PPDB' => 'ppdb',
                ];

                $set('slug', $slugs[$state] ?? '#');
                })
                ->required(),

            Forms\Components\Hidden::make('slug'),

            Forms\Components\TextInput::make('position')
                ->numeric()
                ->required(),

            Forms\Components\Toggle::make('is_active')
                ->default(true),
        ]);
}

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('school_id', auth()->user()->school_id);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([

            Tables\Columns\TextColumn::make('name')
                ->label('Nama Menu'),

            Tables\Columns\TextColumn::make('slug'),

            Tables\Columns\TextColumn::make('position')
                ->label('Urutan'),

            Tables\Columns\IconColumn::make('is_active')
                ->boolean(),
        ])
        ->defaultSort('position', 'asc');
}

public static function getPages(): array
{
    return [
        'index' => Pages\ListMenus::route('/'),
        'create' => Pages\CreateMenu::route('/create'),
        'edit' => Pages\EditMenu::route('/{record}/edit'),
    ];
}
}