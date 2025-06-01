<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;
    // protected function getCreatedNotificationTitle(): ?string
    // {
    //     return 'Barang berhasil ditambahkan';
    // }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil Ditambahkan')
            ->icon('heroicon-o-shield-check')
            ->iconColor('success')
            ->color('success')
            ->duration(5000)
            ->body('Barang berhasil ditambahkan');
    }
}
