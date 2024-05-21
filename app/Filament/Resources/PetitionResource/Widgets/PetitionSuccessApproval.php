<?php

namespace App\Filament\Resources\PetitionResource\Widgets;

use App\Models\Petition;
use Filament\Tables\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PetitionSuccessApproval extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->actions([
                Action::make('View')
                    ->url(fn(Petition $p): string => route('petition.show', $p))
            ])
            ->query(
                // ...
                Petition::query()->where("status_id", 4)
            )
            ->columns([
                // ...
                ImageColumn::make("petition_banner"),
                TextColumn::make("petition_header"),
                TextColumn::make("user.name"),
                SelectColumn::make("status_id")->options([
                    "5"=>"Approve",
                    "6"=>"Disapprove",
                    "7"=>"Block"
                ])
            ]);
    }
}
