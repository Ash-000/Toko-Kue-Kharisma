<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\UserNotification;
use App\Helpers\WhatsAppHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Pesanan';

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Pesanan';

    protected static ?int $navigationSort = 1;

   // Di dalam class OrderResource


public static function getNavigationBadge(): ?string
{
    return static::getModel()::where('status', 'pending')->count() ?: null;
}

public static function getNavigationBadgeColor(): ?string
{
    return 'danger'; // Pakai warna merah biar kontras
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              Select::make('status')
    ->label('Status')
    ->options([
        'pending'     => 'Menunggu Pembayaran',
        'in_progress' => 'Sedang Diproses',
        'shipping'    => 'Dikirim',
        'completed'   => 'Selesai',
        'cancelled'   => 'Dibatalkan',
    ])
    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('No. Pesanan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Pembayaran')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'qris'           => 'QRIS',
                        'cod'            => 'COD',
                        'bank_transfer'  => 'Transfer Bank',
                        default          => strtoupper($state),
                    })
                    ->color(fn ($state) => match ($state) {
                        'qris'           => 'info',
                        'cod'            => 'success',
                        'bank_transfer'  => 'warning',
                        default          => 'gray',
                    }),

                TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

               TextColumn::make('status')
    ->label('Status')
    ->badge()
    ->formatStateUsing(fn ($state) => match ($state) {
        'pending'     => 'Menunggu Pembayaran',
        'in_progress' => 'Diproses',
        'shipping'    => 'Dikirim',
        'completed'   => 'Selesai',
        'cancelled'   => 'Dibatalkan',
        default       => ucfirst($state),
    })
    ->color(fn ($state) => match ($state) {
        'pending'     => 'warning',
        'in_progress' => 'primary',
        'shipping'    => 'info',
        'completed'   => 'success',
        'cancelled'   => 'danger',
        default       => 'gray',
    }),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
              SelectFilter::make('status')
    ->label('Status')
    ->options([
        'pending'     => 'Menunggu Pembayaran',
        'in_progress' => 'Sedang Diproses',
        'shipping'    => 'Dikirim',
        'completed'   => 'Selesai',
        'cancelled'   => 'Dibatalkan',
    ]),

                SelectFilter::make('payment_method')
                    ->label('Metode Bayar')
                    ->options([
                        'qris'           => 'QRIS',
                        'cod'            => 'COD',
                        'bank_transfer'  => 'Transfer Bank',
                    ]),
            ])
          ->actions([
    // 1. Tombol Kirim (Langsung muncul untuk pesanan yang 'in_progress')
    Tables\Actions\Action::make('shipping')
        ->label('Kirim')
        ->icon('heroicon-o-truck')
        ->color('info')
        ->requiresConfirmation()
        ->modalHeading('Kirim Pesanan')
        ->modalDescription('Apakah barang sudah diserahkan ke kurir?')
        ->action(function (Order $record) {
            $record->update(['status' => 'shipping']);
            // Kirim notifikasi ke user
            \App\Models\UserNotification::notify(
                $record->user_id,
                'Pesanan Sedang Dikirim ',
                "Pesanan Anda dengan ID #{$record->order_number} sedang dikirimkan ke alamat Anda.",
                'info'
            );
        })
        ->visible(fn (Order $record) => $record->status === 'in_progress'),

    // 2. Tombol Selesai
    Tables\Actions\Action::make('complete')
        ->label('Selesai')
        ->icon('heroicon-o-check-badge')
        ->color('success')
        ->requiresConfirmation()
        ->action(function (Order $record) {
            $record->update(['status' => 'completed']);
            \App\Models\UserNotification::notify(
                $record->user_id,
                'Pesanan Selesai ✅',
                "Pesanan Anda dengan ID #{$record->order_number} telah selesai. Terima kasih telah berbelanja!",
                'success'
            );
        })
        ->visible(fn (Order $record) => $record->status === 'shipping'),

    // 3. Tombol Batalkan
Tables\Actions\Action::make('cancel')
    ->label('Batalkan')
    ->icon('heroicon-o-x-circle')
    ->color('danger')
    ->requiresConfirmation()
    ->modalHeading('Batalkan Pesanan')
    ->modalDescription('Apakah Anda yakin ingin membatalkan pesanan ini? Tindakan ini tidak dapat dibatalkan.')
    ->action(function (Order $record) {
        $record->update(['status' => 'cancelled']);
        \App\Models\UserNotification::notify(
            $record->user_id,
            'Pesanan Dibatalkan ❌',
            "Maaf, pesanan Anda dengan ID #{$record->order_number} telah dibatalkan oleh penjual.",
            'danger'
        );
    })
    ->visible(fn (Order $record) => in_array($record->status, ['in_progress', 'shipping'])),

    Tables\Actions\ViewAction::make()->label('Detail'),
])
            ->bulkActions([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pesanan')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('order_number')->label('No. Pesanan')->weight('bold'),
                        TextEntry::make('status')
    ->label('Status')
    ->badge()
    ->formatStateUsing(fn ($state) => match ($state) {
        'pending'     => 'Menunggu Pembayaran',
        'in_progress' => 'Diproses',
        'shipping'    => 'Dikirim',
        'completed'   => 'Selesai',
        'cancelled'   => 'Dibatalkan',
        default       => ucfirst($state),
    })
    ->color(fn ($state) => match ($state) {
        'pending'     => 'warning',
        'in_progress' => 'primary',
        'shipping'    => 'info',
        'completed'   => 'success',
        'cancelled'   => 'danger',
        default       => 'gray',
    }),
                        TextEntry::make('user.name')->label('Pelanggan'),
                        TextEntry::make('user.phone')->label('No. Telepon')->default('-'),
                        TextEntry::make('payment_method')->label('Metode Bayar')
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'qris'           => 'QRIS',
                                'cod'            => 'COD',
                                'bank_transfer'  => 'Transfer Bank',
                                default          => strtoupper($state),
                            }),
                        TextEntry::make('created_at')->label('Tanggal Pesan')->dateTime('d M Y, H:i'),
                        TextEntry::make('notes')->label('Catatan')->default('-')->columnSpanFull(),
                        TextEntry::make('delivery_address')->label('Alamat Pengiriman')->default('-')->columnSpanFull(),
                    ]),

                Section::make('Rincian Harga')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('subtotal')->label('Subtotal')->money('IDR'),
                        TextEntry::make('shipping_cost')->label('Ongkos Kirim')->money('IDR'),
                        TextEntry::make('discount')->label('Diskon')->money('IDR'),
                        TextEntry::make('total')->label('Total')->money('IDR')->weight('bold'),
                    ]),

                Section::make('Item Pesanan')
                    ->schema([
                        RepeatableEntry::make('orderItems')
                            ->label('')
                            ->schema([
                                TextEntry::make('product.name')->label('Produk'),
                                TextEntry::make('quantity')->label('Qty'),
                                TextEntry::make('price')->label('Harga Satuan')->money('IDR'),
                                TextEntry::make('subtotal')->label('Subtotal')->money('IDR'),
                            ])
                            ->columns(4),
                    ]),

                Section::make('Bukti Pembayaran (Transfer Bank)')
                    ->visible(fn (Order $record) => $record->payment_method === 'bank_transfer')
                    ->schema([
                        TextEntry::make('paymentProof.bank_name')
                            ->label('Bank Pengirim')
                            ->default('-'),
                        TextEntry::make('paymentProof.account_name')
                            ->label('Atas Nama')
                            ->default('-'),
                        TextEntry::make('paymentProof.amount')
                            ->label('Jumlah Transfer')
                            ->money('IDR')
                            ->default('-'),
                        TextEntry::make('paymentProof.status')
                            ->label('Status Bukti')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'pending'   => 'Menunggu Verifikasi',
                                'verified'  => 'Diverifikasi',
                                'rejected'  => 'Ditolak',
                                default     => '-',
                            })
                            ->color(fn ($state) => match ($state) {
                                'pending'   => 'warning',
                                'verified'  => 'success',
                                'rejected'  => 'danger',
                                default     => 'gray',
                            })
                            ->default('-'),
                        \Filament\Infolists\Components\ImageEntry::make('paymentProof.proof_image')
                            ->label('Bukti Transfer')
                            ->disk('public')
                            ->default('-'),
                        TextEntry::make('paymentProof.admin_notes')
                            ->label('Catatan Admin')
                            ->default('-')
                            ->markdown(),
                    ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view'  => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
