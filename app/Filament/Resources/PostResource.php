<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\User; // Penting untuk type casting isSuperAdmin()
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $pluralModelLabel = 'Berita';

    // --- FILAMENT RESOURCE DEFINITIONS (FORM, TABLE, ETC.) ---

    // 1. Mengontrol siapa yang bisa melihat menu "Posts"
    public static function canViewAny(): bool
    {
        $user = auth()->user();
        
        // Hanya izinkan Admin Pusat dan Admin Sekolah (yang terikat pada sekolah)
        return $user instanceof User && ($user->isSuperAdmin() || $user->school_id !== null);
    }
    
    // 2. Modifikasi getEloquentQuery untuk memfilter data
    public static function getEloquentQuery(): Builder
{
    $user = auth()->user();

    // Jika user adalah admin_pusat, jangan filter data berdasarkan sekolah
    if ($user && $user->role === 'admin_pusat') {
        return parent::getEloquentQuery()->withoutGlobalScopes(); 
    }

    // Untuk admin sekolah biasa, tetap tampilkan data sekolahnya saja
    return parent::getEloquentQuery();
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('photo_url') // Nama harus sama dengan di migrasi
                    ->label('Foto Berita')
                    ->image()
                    ->directory('posts')
                    ->disk('public')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                // Di dalam StudentResource/TeacherResource/EskulResource
                Tables\Columns\TextColumn::make('school.name')
                    ->label('Sekolah Terkait')
                    ->visible(fn () => auth()->user()->role === 'admin_pusat') // Hanya muncul untuk Admin Pusat
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('photo_url')
                    ->label('Foto')
                    ->circular(), // Menggunakan gaya bulat agar senada dengan TeacherResource Anda
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}