<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                Select::make('status')
                    ->required()
                    ->label('Status')
                    ->options([
                        'new' => 'New',
                        'accepted' => 'Accepted',
                        'preparing' => 'Preparing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                    ])
                    ->searchable(),
                Select::make('payment_id')
                    ->required()
                    ->label('Payment')
                    ->options(Payment::all()->pluck('name', 'id'))
                    ->searchable(),
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')->searchable(),
                TextColumn::make('payment.name')->searchable(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
