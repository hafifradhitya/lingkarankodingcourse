<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                ->maxLength(255)
                ->required(),

                TextInput::make('email')
                ->maxLength(255)
                ->email()
                ->required(),

                TextInput::make('password')
                ->password()
                ->placeholder('********') // hanya tampilan
                ->revealable()
                ->hint('Biarkan kosong jika tidak diganti')
                ->helperText('Minimum 9 characters')
                ->required(fn (string $context): bool => $context === 'create')
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->dehydrated(fn ($state) => filled($state)) // tidak simpan kalau kosong
                ->minLength(9)
                ->maxLength(255),

                Select::make('occupation')
                ->options([
                    'Full Stack Developer' => 'Full Stack Developer',
                    'Designer' => 'Designer',
                    'Backend Developer' => 'Backend Developer',
                    'Cyber Security' => 'Cyber Security',
                    'Project Manager' => 'Project Manager',
                    'Frontend Developer' => 'Frontend Developer',
                    'Data Analyst' => 'Data Analyst'
                ])
                ->required(),

                Select::make('roles')
                ->label('Role')
                ->relationship('roles', 'name')
                ->required(),

                FileUpload::make('photo')
                ->required()
                ->image()
                ->disk('public')       // <- WAJIB biar ga nyasar ke local
                ->directory('users'),   // simpan di storage/app/public/users
            ]);
    }
}
