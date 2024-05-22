<?php

namespace App\Filament\Resources\PetitionResource\Pages;

use App\Filament\Resources\PetitionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPetition extends EditRecord
{
    protected static string $resource = PetitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if(is_null($data["petition_banner"])) unset($data["petition_banner"]);
        return $data;
    }
}
