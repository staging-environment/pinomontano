<?php

namespace App\Filament\Resources\Businesses\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;

class BusinessForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles del Comercio')
                    ->description('Información principal y de contacto del negocio solicitado.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del Negocio')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('URL Amigable (Slug)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'Restauración' => 'Restauración',
                                'Alimentación' => 'Alimentación',
                                'Servicios' => 'Servicios',
                                'Salud y Belleza' => 'Salud y Belleza',
                                'Peluquerías' => 'Peluquerías',
                                'Otros' => 'Otros',
                            ])
                            ->required(),

                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(20)
                            ->required(),

                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->maxLength(255)
                            ->required(),

                        TextInput::make('website')
                            ->label('Sitio Web')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('address')
                            ->label('Dirección Física')
                            ->maxLength(255)
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('latitude')
                            ->label('Latitud')
                            ->numeric()
                            ->required(),

                        TextInput::make('longitude')
                            ->label('Longitud')
                            ->numeric()
                            ->required(),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->maxLength(1000)
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2)->columnSpan(['lg' => 2]),

                Section::make('Moderación y Estado')
                    ->description('Controla la visibilidad y destaque del negocio en la plataforma pública.')
                    ->schema([
                        Toggle::make('is_approved')
                            ->label('Aprobado / Publicado')
                            ->helperText('Si está activado, este comercio se mostrará inmediatamente en el Marketplace.')
                            ->default(false),

                        Toggle::make('is_featured')
                            ->label('Comercio Destacado')
                            ->helperText('Si está activado, aparecerá en las primeras posiciones y tendrá un distintivo dorado.')
                            ->default(false),
                    ])->columns(1)->columnSpan(['lg' => 1]),
            ])->columns(3);
    }
}
