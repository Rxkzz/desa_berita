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
use Rawilk\FilamentQuill\Filament\Forms\Components\QuillEditor; 
use Rawilk\FilamentQuill\Enums\ToolbarButton; 
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BeritaResource extends Resource
{
    protected static ?string $model = \App\Models\Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Berita';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                QuillEditor::make('content') 
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
            ->columns([
                TextColumn::make('author.name')->label('Author'),
                TextColumn::make('kategoriBerita.title')->label('Kategori'),
                TextColumn::make('title'),
                TextColumn::make('slug'),
                ImageColumn::make('thumbnail'),
                TextColumn::make('view_count')
                ->label('Views')
                ->sortable()
                ->numeric(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable(),
               
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('author_id', Auth::id());
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
