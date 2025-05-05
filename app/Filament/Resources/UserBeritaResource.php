<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserBeritaResource\Pages;
use App\Filament\Resources\UserBeritaResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class UserBeritaResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Berita';
    protected static ?string $navigationIcon = 'heroicon-o-users'; 

    protected static ?string $navigationLabel = 'Statistik Berita Pengguna'; 

    protected static ?string $slug = 'statistik-berita-pengguna'; 

    public static function form(Form $form): Form
    {
     
        return $form
            ->schema([
              
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email Pengguna')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('beritas_count')
                    ->counts('beritas') 
                    ->label('Jumlah Berita Dibuat')
                    ->sortable(), 
            ])
            ->filters([
              
            ])
            ->actions([
               
            ])
            ->bulkActions([
              
            ]);
    }

    public static function getRelations(): array
    {
        return [
             
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserBeritas::route('/'),
           ];
    }

   
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('beritas'); 
    }

   
    public static function canCreate(): bool
    {
        return false; 
    }

   
}