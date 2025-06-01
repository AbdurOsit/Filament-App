<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Filament\Resources\PenjualanResource\RelationManagers;
use App\Models\PenjualanModel;
use App\Models\Faktur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenjualanResource extends Resource
{
    protected static ?string $model = PenjualanModel::class;
    protected static ?string $navigationGroup = 'Faktur';
    protected static ?string $navigationLabel = 'Laporan Penjualan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string  $slug = 'laporan-penjualan';
    protected static ?string $label = 'Laporan Penjualan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('kode_penjualan')
                //     ->label('Kode Penjualan')
                //     ->searchable()
                //     ->sortable(),
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->searchable()
                    ->sortable()
                    ->date('d F Y'),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn(PenjualanModel $record): string => 'Rp' . number_format($record->jumlah, 0,'.','.') ),
                TextColumn::make('customer.nama_customer')
                    ->label('Nama Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'info',
                    })
                    ->formatStateUsing(fn(PenjualanModel $record): string => $record->ststus == 0 ? 'Utang' : 'Lunas' )
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                // TextColumn::make('keterangan')
                //     ->label('Keterangan')
                //     ->searchable()
                //     ->sortable(),
            ])
            ->emptyStateHeading('Tidak ada laporan')
            ->emptyStateDescription('Silahkan tambahkan faktur terlebih dahulu')
            ->emptyStateIcon('heroicon-o-presentation-chart-bar')
            ->emptyStateActions([
            Action::make('create')
                ->label('Buat Faktur')
                ->url(route('filament.admin.resources.fakturs.create'))
                ->icon('heroicon-m-plus')
                ->button(),
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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
