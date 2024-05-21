<?php

namespace App\Filament\Resources\SignedPetitionResource\Pages;

use App\Filament\Resources\SignedPetitionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSignedPetition extends EditRecord
{
    protected static string $resource = SignedPetitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
