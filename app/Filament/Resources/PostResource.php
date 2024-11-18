<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;



class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255), // Máximo de caracteres
                Textarea::make('content')
                    ->label('Contenido')
                    ->required(), // Campo requerido
            ]);
    }
    

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('title')
                ->label('Título')
                ->sortable() // Permite ordenar la columna
                ->searchable(), // Habilita la búsqueda
            TextColumn::make('created_at')
                ->label('Fecha de Creación')
                ->dateTime(), // Muestra la fecha y hora
        ])
        ->filters([
            // Aquí puedes añadir filtros si es necesario
        ])
        ->actions([
            Tables\Actions\EditAction::make(), // Acción para editar un registro
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(), // Acción para eliminar varios registros
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
