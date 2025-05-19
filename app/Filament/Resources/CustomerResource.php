<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\CustomerModel;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = CustomerModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Kelola';
    protected static ?string $navigationLabel = 'Kelola Customer';
    protected static ?string $slug = 'kelola-customer';
    public static ?string $label = 'Kelola Customer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_customer')
                    ->label('Nama')
                    ->placeholder('example:Niga')
                    ->required(),
                TextInput::make('kode_customer')
                    ->label('Kode')
                    ->placeholder('example:N1G4')
                    ->required(),
                TextInput::make('alamat_customer')
                    ->label('Alamat')
                    ->placeholder('example:Batam')
                    ->required(),
                TextInput::make('telepon_customer')
                    ->label('Telepon')
                    ->placeholder('example:0897162547281')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_customer')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kode_customer')
                    ->copyable()
                    ->copyMessage('Berhasil Menyalin')
                    ->label('Kode'),
                TextColumn::make('alamat_customer')
                    ->label('Alamat'),
                TextColumn::make('telepon_customer')
                ->copyable()
                    ->copyMessage('Berhasil Menyalin')
                    ->label('Telepon'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
