<?php

namespace App\Filament\Resources\CourseMentors\Pages;

use App\Filament\Resources\CourseMentors\CourseMentorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseMentor extends CreateRecord
{
    protected static string $resource = CourseMentorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
