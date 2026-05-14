<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->extraAttributes(['novalidate' => true])
            ->schema([
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Otomatis terisi dari nama produk. Bisa diedit manual.')
                    ->maxLength(255),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Kue'     => 'Kue',
                        'Snack'   => 'Snack',
                        'Minuman' => 'Minuman',
                    ])
                    ->required(),

                TextInput::make('price')
                    ->label('Harga (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('image_url')
                    ->label('Gambar Produk')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('400')
                    ->imageResizeTargetHeight('400')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->helperText('Upload gambar produk (JPG, PNG, WebP, maks 2MB). Drag & drop atau klik untuk memilih.')
                    // Simpan sebagai path relatif storage/app/public/products/...
                    ->getUploadedFileNameForStorageUsing(
                        fn ($file): string => 'products/' . str()->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension()
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Foto')
                    ->width(60)
                    ->height(60)
                    ->disk('public')
                    ->defaultImageUrl(asset('images/no-image.png')),

                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->copyable()
                    ->color('gray'),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Kue'     => 'Kue',
                        'Snack'   => 'Snack',
                        'Minuman' => 'Minuman',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus Terpilih'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
