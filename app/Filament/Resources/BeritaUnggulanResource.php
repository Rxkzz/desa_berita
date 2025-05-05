<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaUnggulanResource\Pages;
use App\Models\BeritaUnggulan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;
use App\Models\Berita;

class BeritaUnggulanResource extends Resource
{
    protected static ?string $model = BeritaUnggulan::class;
    protected static ?string $navigationGroup = 'Berita';
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Kelola Berita Unggulan';
    protected static ?string $label = 'Berita Unggulan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->disabled(),
                Forms\Components\TextInput::make('slug')->disabled(),
                Forms\Components\FileUpload::make('thumbnail')->image()->disabled(),
                Forms\Components\RichEditor::make('content')->disabled(),
                Forms\Components\Toggle::make('is_featured')->label('Tandai Sebagai Unggulan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn () => Berita::query())
            ->columns([
                TextColumn::make('author.name')->label('Author'),
                TextColumn::make('title'),
                ImageColumn::make('thumbnail'),
                ToggleColumn::make('is_featured')
                    ->label('Unggulan')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('is_featured')
                    ->options([
                        1 => 'Unggulan',
                        0 => 'Biasa',
                    ])
                    ->label('Status Unggulan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritaUnggulans::route('/'),
            'edit' => Pages\EditBeritaUnggulan::route('/{record}/edit'),
        ];
    }
}
