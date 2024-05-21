<?php

namespace App\Filament\Resources\PetitionResource\Widgets;

use App\Models\Petition;
use App\Models\SignedPetition;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PetitionsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make("Succeded petitions",Petition::where("status",3)->count()),
            Stat::make("Total petitions",Petition::count()),
            Stat::make("Sign count",SignedPetition::count()),
            Stat::make("Total users",User::count())
        ];
    }
}
