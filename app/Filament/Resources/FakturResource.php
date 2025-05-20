<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturResource\Pages;
use App\Filament\Resources\FakturResource\RelationManagers;
use App\Models\CustomerModel;
use App\Models\Faktur;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_faktur'),
                DatePicker::make('tanggal_faktur')
                    ->displayFormat('d m Y')
                    ->locale('id'),
                TextInput::make('kode_faktur')->numeric(),
                // TextInput::make('customer_id'),
                Select::make('customer_id')
                    ->label('ID Customer')
                    ->relationship('customer', 'nama_customer'),
                Repeater::make('detail')
                    ->relationship()
                    ->schema([
                        Select::make('barang_id')
                            ->relationship('barang','nama_barang'),
                        TextInput::make('diskon')->numeric(),
                        TextInput::make('nama_barang'),
                        TextInput::make('harga')->numeric(),
                        TextInput::make('subtotal')->numeric(),
                        TextInput::make('qty')->numeric(),
                        TextInput::make('hasil_qty')->numeric(),
                    ]),
                TextInput::make('ket_faktur'),
                TextInput::make('total')->numeric(),
                TextInput::make('nominal_charge')->numeric(),
                TextInput::make('charge')->numeric(),
                TextInput::make('total_final')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_faktur'),
                TextColumn::make('tanggal_faktur'),
                TextColumn::make('kode_faktur'),
                TextColumn::make('customer.nama_customer'),
                TextColumn::make('ket_faktur'),
                TextColumn::make('total'),
                TextColumn::make('nominal_charge'),
                TextColumn::make('charge'),
                TextColumn::make('total_final'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
