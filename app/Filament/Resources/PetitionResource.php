<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetitionResource\Pages;
use App\Filament\Resources\PetitionResource\RelationManagers;
use App\Models\Petition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PetitionResource extends Resource
{
    protected static ?string $model = Petition::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('petition_header')
                    ->required(),
                Forms\Components\Select::make('creator')->relationship(name:"user",titleAttribute:"name")
                    ->required(),
                Forms\Components\TextInput::make('target_sign')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('status')->relationship(name: "status", titleAttribute: "status"),
                Forms\Components\RichEditor::make('petition_content')
                ->required()
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('petition_banner')
                ->disk("s3")
                ->directory("petition_content/{$form->model->id}")
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file): string => (string) str("banner.jpg"),
                )
                ->visibility("private")
                ->image()
                ->previewable(false)
                ->columnSpanFull(),
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
                ImageColumn::make("petition_banner"),
                Tables\Columns\TextColumn::make('petition_header')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.status')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
                SelectFilter::make("status_id")->options([
                    "1" => "waiting for approval", 
                    "2" => "approved", 
                    "3" => "disapproved", 
                    "4" => "waiting for success approval", 
                    "5" => "success approved",
                    "6"=>"success disapproved",
                    "7"=>"blocked",
                ])
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
            'index' => Pages\ListPetitions::route('/'),
            'edit' => Pages\EditPetition::route('/{record}/edit'),
        ];
    }
}
