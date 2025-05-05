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
use Rawilk\FilamentQuill\Filament\Forms\Components\QuillEditor; // Correct import
use Rawilk\FilamentQuill\Enums\ToolbarButton; // Import ToolbarButton enum
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BeritaResource extends Resource
{
    protected static ?string $model = \App\Models\Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Berita';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Hapus Select author_id, author_id akan di-set otomatis di backend
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
                QuillEditor::make('content') // Updated usage
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('uploads/berita')
                    ->required()
                    ->toolbarButtons([
                        ToolbarButton::Font,
                        ToolbarButton::Size,
                        ToolbarButton::Bold,
                        ToolbarButton::Italic,
                        ToolbarButton::Underline,
                        ToolbarButton::Strike,
                        ToolbarButton::BlockQuote,
                        ToolbarButton::OrderedList,
                        ToolbarButton::UnorderedList,
                        ToolbarButton::Indent,
                        ToolbarButton::Link,
                        ToolbarButton::Image,
                        ToolbarButton::Scripts,
                        ToolbarButton::TextAlign,
                        ToolbarButton::TextColor,
                        ToolbarButton::BackgroundColor,
                        ToolbarButton::Undo,
                        ToolbarButton::Redo,
                        ToolbarButton::ClearFormat,
                    ])
                    ->placeholders([
                        'USER_NAME',
                        'USER_EMAIL',
                        'CURRENT_DATE',
                    ])
                    ->surroundPlaceholdersWith(start: '{{ ', end: ' }}'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                // Pastikan memanggil scope pada model Berita
                return Berita::query()->accessibleByUser(Auth::user());
            })
            ->columns([
                TextColumn::make('author.name')->label('Author'),
                TextColumn::make('kategoriBerita.title')->label('Kategori'),
                TextColumn::make('title'),
                TextColumn::make('slug'),
                ImageColumn::make('thumbnail'),
               
            ])
            ->filters([
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
