<?php

namespace App\Filament\Resources\PetitionStatusResource\Pages;

use App\Filament\Resources\PetitionStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPetitionStatuses extends ListRecords
{
    protected static string $resource = PetitionStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
