<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Helpers\WhatsAppHelper;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Notifications\Notification;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('verify')
                ->label('Verifikasi')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Verifikasi Pesanan')
                ->modalDescription('Pesanan akan diubah statusnya menjadi "Diverifikasi" dan notifikasi WhatsApp akan dikirim ke customer.')
                ->action(function () {
                    $this->record->load(['user', 'orderItems.product']);
                    $this->record->update(['status' => 'verified']);

                    $waUrl = WhatsAppHelper::buildUrl($this->record);

                    Notification::make()
                        ->title('Pesanan berhasil diverifikasi')
                        ->body($waUrl
                            ? 'Klik tombol WhatsApp untuk notifikasi customer.'
                            : 'Customer tidak memiliki nomor telepon.')
                        ->success()
                        ->actions($waUrl ? [
                            \Filament\Notifications\Actions\Action::make('whatsapp')
                                ->label('Kirim WhatsApp')
                                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                                ->url($waUrl, shouldOpenInNewTab: true),
                        ] : [])
                        ->persistent()
                        ->send();

                    $this->refreshFormData(['status']);
                })
                ->visible(fn () => $this->record->status === 'pending'),

            Actions\Action::make('process')
                ->label('Proses')
                ->icon('heroicon-o-cog-6-tooth')
                ->color('primary')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'in_progress']);
                    $this->refreshFormData(['status']);
                })
                ->visible(fn () => $this->record->status === 'verified'),

            Actions\Action::make('complete')
                ->label('Selesai')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'completed']);
                    $this->refreshFormData(['status']);
                })
                ->visible(fn () => $this->record->status === 'in_progress'),

            Actions\Action::make('cancel')
                ->label('Batalkan')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'cancelled']);
                    $this->refreshFormData(['status']);
                })
                ->visible(fn () => in_array($this->record->status, ['pending', 'verified'])),
        ];
    }
}
