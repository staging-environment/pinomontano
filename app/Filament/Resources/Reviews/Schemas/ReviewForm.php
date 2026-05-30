<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use App\Models\Business;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles de la Valoración')
                    ->description('Gestiona el comentario y puntuación del vecino.')
                    ->schema([
                        Select::make('business_id')
                            ->label('Comercio')
                            ->options(Business::pluck('name', 'id'))
                            ->required(),

                        TextInput::make('author_name')
                            ->label('Nombre del Autor')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('rating')
                            ->label('Puntuación (1-5)')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(5),

                        Textarea::make('comment')
                            ->label('Comentario')
                            ->required()
                            ->maxLength(1000)
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2)->columnSpan(['lg' => 2]),

                Section::make('Moderación')
                    ->description('Controla la visibilidad pública de este comentario.')
                    ->schema([
                        Toggle::make('is_approved')
                            ->label('Aprobado / Publicado')
                            ->helperText('Si se desactiva, no se mostrará en la ficha del negocio.')
                            ->default(true),
                    ])->columns(1)->columnSpan(['lg' => 1]),
            ])->columns(3);
    }
}
