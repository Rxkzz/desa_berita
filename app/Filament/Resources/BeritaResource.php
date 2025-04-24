<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('author_id')
                ->relationship('author', 'name')
                ->required(),
                Select::make('kategori_berita_id')
                ->relationship('kategoriBerita', 'title') 
                ->required(),
                TextInput::make('title')
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->required(),
                TextInput::make('slug')
                ->required(),
                FileUpload::make('thumbnail')
                ->image()
                ->columnSpanFull()
                ->required(),
                RichEditor::make('content')
                ->columnSpanFull()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author_id'),
                TextColumn::make('kategoriBerita.title'),
                TextColumn::make('title'),
                TextColumn::make('slug'),
                ImageColumn::make('thumbnail'),
            ])
            ->filters([
                SelectFilter::make('author_id')
                    ->relationship('author', 'name')
                    ->label('Pilih author'),
                SelectFilter::make('kategori_berita_id')
                    ->relationship('kategoriBerita', 'title')
                    ->label('Pilih Kategori'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
