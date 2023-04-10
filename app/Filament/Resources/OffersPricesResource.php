<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OffersPricesResource\Pages;
use App\Filament\Resources\OffersPricesResource\RelationManagers;
use App\Models\OffersPrices;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OffersPricesResource extends Resource
{
    protected static ?string $model = OffersPrices::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('description')
                        ->required()
                        ->maxLength(255)
                        ->placeholder("description"),
                    FileUpload::make('file')
                        ->required()
                        ->preserveFilenames()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('description')->searchable(),
                TextColumn::make('file')->url(fn (OffersPrices $record): string => url('public/storage/' . $record->file))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListOffersPrices::route('/'),
            'create' => Pages\CreateOffersPrices::route('/create'),
            'edit' => Pages\EditOffersPrices::route('/{record}/edit'),
        ];
    }
}
