<?php

namespace App\Filament\Resources\SignedPetitionResource\Pages;

use App\Filament\Resources\SignedPetitionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSignedPetitions extends ListRecords
{
    protected static string $resource = SignedPetitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
