<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MerchantResource\Pages;
use App\Filament\Resources\MerchantResource\RelationManagers;
use App\Models\Merchant;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MerchantResource extends Resource
{
    protected static ?string $model = Merchant::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                Select::make('user_id')
                    ->required()
                    ->label('Name')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
                // TextInput::make('product_status')   //enum
                //     ->required()
                //     ->maxLength(100)
                //     ->placeholder("Status"),
                // TextInput::make('product_qty')   //number
                //     ->required()
                //     ->maxLength(10)
                //     ->placeholder("Quantity"),
                // TextInput::make('product_price')
                //     ->required()
                //     ->maxLength(50)
                //     ->placeholder("Price"),
                // TextInput::make('product_img')   //select image
                //     ->maxLength(100)
                //     ->placeholder("Image"),
                TextInput::make('bank_name')
                    ->maxLength(100)
                    ->placeholder("Bank Name"),
                TextInput::make('iban')
                    ->maxLength(100)
                    ->placeholder("IBAN"),
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->searchable(),
                // TextColumn::make('product_status')->searchable(),
                // TextColumn::make('product_qty'),
                // TextColumn::make('product_price')->searchable(),
                // TextColumn::make('product_img'),   //show image
                TextColumn::make('bank_name')->searchable(),
                TextColumn::make('iban'),
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
            'index' => Pages\ListMerchants::route('/'),
            'create' => Pages\CreateMerchant::route('/create'),
            'edit' => Pages\EditMerchant::route('/{record}/edit'),
        ];
    }
}
