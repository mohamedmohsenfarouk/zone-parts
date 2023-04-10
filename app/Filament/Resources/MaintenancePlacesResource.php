<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenancePlacesResource\Pages;
use App\Filament\Resources\MaintenancePlacesResource\RelationManagers;
use App\Models\MaintenancePlaces;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenancePlacesResource extends Resource
{
    protected static ?string $model = MaintenancePlaces::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(100)
                        ->placeholder("Name"),
                    TextInput::make('location')
                        ->required()
                        ->maxLength(255)
                        ->placeholder("Location"),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('location')->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('M j, Y')->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMaintenancePlaces::route('/'),
            'create' => Pages\CreateMaintenancePlaces::route('/create'),
            'edit' => Pages\EditMaintenancePlaces::route('/{record}/edit'),
        ];
    }
}
