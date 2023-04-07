<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Card::make()->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(100)
                ->placeholder("Name"),
            TextInput::make('email')
                ->email()
                ->required()
                ->placeholder("Email")
                ->maxLength(100),
            TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (Page $livewire) => ($livewire instanceof CreateUser)) // to make field nor required in edit
                ->placeholder("Password")
                ->maxLength(50),
            // to hide field in edit
            // ->visible(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser),
            TextInput::make('area')
                ->placeholder("Area")
                ->maxLength(50),
            TextInput::make('address')
                ->placeholder("Address")
                ->maxLength(100),
            TextInput::make('phone')
                ->tel()
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                ->placeholder("Phone")
                ->maxLength(20),

            Select::make('role_id')
                ->multiple()
                ->relationship('roles', 'name')
                ->preload(),

            Select::make('permissions')
                ->multiple()
                ->relationship('permissions', 'name')
                ->preload(),
               ])
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                Tables\Columns\BooleanColumn::make('email_verified_at')->label('Verified'),
                TextColumn::make('created_at')
                    ->dateTime('M j, Y')->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
