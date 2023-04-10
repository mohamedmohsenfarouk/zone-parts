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
use Filament\Tables\Columns\BooleanColumn;
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
                        ->maxLength(100)
                        ->unique(ignoreRecord: true),
                    TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (Page $livewire) => ($livewire instanceof CreateUser)) // to make field nor required in edit
                        ->placeholder("Password")
                        ->maxLength(50),
                    // to hide field in edit
                    // ->visible(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser),
                    TextInput::make('country_code')
                        ->tel()
                        ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                        ->placeholder("Country Code")
                        ->maxLength(5),
                    TextInput::make('phone')
                        ->tel()
                        ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                        ->placeholder("Phone")
                        ->maxLength(20),
                    TextInput::make('area')
                        ->placeholder("Area")
                        ->maxLength(50),
                    TextInput::make('address')
                        ->placeholder("Address")
                        ->maxLength(100),
                    Select::make('status')
                        ->options([
                            '1' => 'Active',
                            '0' => 'Inactive',
                        ]),
                    Select::make('role_id')
                        ->multiple()
                        ->relationship('roles', 'name')
                        ->preload(),
                    Select::make('permissions')
                        ->multiple()
                        ->relationship('permissions', 'name')
                        ->preload(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('roles.name'),
                TextColumn::make('phone')->label('Phone'),
                BooleanColumn::make('status')->label('Status'),
                TextColumn::make('created_at')
                    ->dateTime('M j, Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('status')
                    ->query(fn (Builder $query): Builder => $query->where('status', "=",1)),
                Tables\Filters\Filter::make('status')
                    ->query(fn (Builder $query): Builder => $query->where('status', "=",0)),
                    Tables\Filters\Filter::make('phone')
                    ->query(fn (Builder $query): Builder => $query->where('status', "=",0)),
            
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
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
