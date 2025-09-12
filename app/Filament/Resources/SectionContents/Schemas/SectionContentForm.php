<?php

namespace App\Filament\Resources\SectionContents\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class SectionContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                //
                Fieldset::make("Manage Content")
                ->schema([
                    Select::make('course_section_id')
                    ->label('Course Section')
                    ->options(function () {
                        return \App\Models\CourseSection::with('course')
                            ->get()
                            ->mapWithKeys(function ($section) {
                                return [
                                    $section->id => $section->course
                                        ? "{$section->course->name} - {$section->name}"
                                        : $section->name,
                                ];
                            })
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('path_video'),

                    RichEditor::make('content')
                        ->columnSpanFull()
                        ->required()
                        ->extraAttributes(['style' => 'min-height: 400px; height: 100%;']),
                ])
                ->columns(2)
                ->columnSpanFull(),
            ]);
    }
}
