<?php

namespace App\Filament\Resources\PetitionStatusResource\Pages;

use App\Filament\Resources\PetitionStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPetitionStatus extends EditRecord
{
    protected static string $resource = PetitionStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
