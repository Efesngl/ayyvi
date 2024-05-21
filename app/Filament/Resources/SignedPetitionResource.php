<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SignedPetitionResource\Pages;
use App\Filament\Resources\SignedPetitionResource\RelationManagers;
use App\Models\SignedPetition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SignedPetitionResource extends Resource
{
    protected static ?string $model = SignedPetition::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('petition_name')
                    ->relationship('petition', 'petition_header'),
                    Forms\Components\Toggle::make('will_shown')
                    ->required(),
                    Forms\Components\TextInput::make('reason')->requiredIf("will_shown","true"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('petition.petition_header')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('likes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reason')
                    ->searchable(),
                Tables\Columns\IconColumn::make('will_shown')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSignedPetitions::route('/'),
            'create' => Pages\CreateSignedPetition::route('/create'),
            'edit' => Pages\EditSignedPetition::route('/{record}/edit'),
        ];
    }
}
