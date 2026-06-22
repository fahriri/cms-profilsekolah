<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Section Homepage';

    protected static ?string $navigationGroup = 'Website';


public static function form(Form $form): Form
{
    return $form
        ->schema([

            Forms\Components\Hidden::make('school_id')
                ->default(auth()->user()->school_id),

            Forms\Components\Select::make('name')
                ->label('Pilih Section')
                ->options([
                    'Banner' => 'Banner',
                    'Profil' => 'Profil',
                    'Berita' => 'Berita',
                    'Statistik' => 'Statistik',
                    // 'Guru' => 'Guru',
                    // 'Galeri' => 'Galeri',
                    // 'Fasilitas' => 'Fasilitas',
                    // 'Ekstrakurikuler' => 'Ekstrakurikuler',
                    // 'PPDB' => 'PPDB',
                ])
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {

                    $keys = [
                        'Banner' => 'banner',
                        'Profil' => 'profil',
                        'Berita' => 'berita',
                        'Statistik' => 'statistik',
                        // 'Guru' => 'guru',
                        // 'Galeri' => 'galeri',
                        // 'Fasilitas' => 'fasilitas',
                        // 'Ekstrakurikuler' => 'ekstrakurikuler',
                        // 'PPDB' => 'ppdb',
                    ];

                    $set('key', $keys[$state] ?? null);
                })
                ->required(),

            Forms\Components\Hidden::make('key'),

            Forms\Components\TextInput::make('position')
                ->numeric()
                ->required(),

            Forms\Components\Toggle::make('is_active')
                ->default(true),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([ 
                Tables\Columns\TextColumn::make('name') ->label('Nama Section'), 
                Tables\Columns\TextColumn::make('key') ->label('Key'), 
                Tables\Columns\TextColumn::make('position') ->label('Urutan'), 
                Tables\Columns\IconColumn::make('is_active') ->label('Aktif') ->boolean(), 
                ])

            ->actions([
                Tables\Actions\EditAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])

            ->defaultSort('position', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('school_id', auth()->user()->school_id);
    }
}
