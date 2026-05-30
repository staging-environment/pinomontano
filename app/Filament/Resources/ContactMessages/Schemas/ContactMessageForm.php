<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles del Mensaje')
                    ->description('Detalles del mensaje recibido desde el formulario de contacto.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del Remitente')
                            ->disabled(),

                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->disabled(),

                        TextInput::make('subject')
                            ->label('Asunto')
                            ->disabled(),

                        Textarea::make('message')
                            ->label('Mensaje')
                            ->disabled()
                            ->rows(6)
                            ->columnSpanFull(),
                    ])->columns(2)->columnSpanFull()
            ]);
    }
}
