<?php

namespace App\Filament\Resources\Courses\RelationManagers;

use App\Filament\Resources\Tools\ToolResource;
use Filament\Actions\BulkActionGroup;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ToolsRelationManager extends RelationManager
{
    protected static string $relationship = 'tools';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('logo')
                    ->required()
                    ->image()
                    ->disk('public')       // <- WAJIB biar ga nyasar ke local
                    ->directory('tools'),   // simpan di storage/app/public/users

                TextInput::make('category')
                    ->required()
                    ->maxLength(255),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name'),

                ImageColumn::make('logo')
                    ->disk('public'),

                TextColumn::make('category'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
