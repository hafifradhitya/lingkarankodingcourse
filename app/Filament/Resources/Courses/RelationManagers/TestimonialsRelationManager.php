<?php

namespace App\Filament\Resources\Courses\RelationManagers;

use App\Filament\Resources\Testimonials\TestimonialResource;
use Filament\Actions\BulkActionGroup;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialsRelationManager extends RelationManager
{
    protected static string $relationship = 'testimonials';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->required()
                    ->image()
                    ->disk('public')       // <- WAJIB biar ga nyasar ke local
                    ->directory('testimonials'),   // simpan di storage/app/public/users

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

                Textarea::make('review')
                    ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name'),

                ImageColumn::make('photo')
                    ->disk('public'),

                TextColumn::make('occupation'),
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
