<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                //
                Fieldset::make('Details')
                ->schema([
                    TextInput::make('name')
                    ->maxLength(255)
                    ->required(),

                    FileUpload::make('thumbnail')
                    ->required()
                    ->image()
                    ->disk('public')       // <- WAJIB biar ga nyasar ke local
                    ->directory('courses'),   // simpan di storage/app/public/users
                ])
                ->columns(2)
                ->columnSpanFull(),

                Fieldset::make('Additional')
                ->schema([
                    Repeater::make('benefits')
                    ->relationship('benefits')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                    ]),

                    Textarea::make('about')
                    ->required(),

                    Toggle::make('is_free')
                    ->label('Is Free Course')
                    ->inline(false)
                    ->helperText('Jika aktif: semua user bisa mengakses tanpa subscription.')
                    ->default(false),

                    Select::make('is_popular')
                    ->options([
                        true => 'Popular',
                        false => 'Not Popular',
                    ])
                    ->required(),

                    Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
            ]);
    }
}
