<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Bolu Pelangi',
                'description' => 'Bolu lembut dengan 7 lapisan warna pelangi yang cantik dan lezat',
                'price' => 2000,
                'stock' => 50,
                'category' => 'Kue',
                'image_url' => '/images/products/bolu-pelangi.jpg',
            ],
            [
                'name' => 'Pie Buah',
                'description' => 'Pie dengan isian buah segar',
                'price' => 2000,
                'stock' => 40,
                'category' => 'Kue',
                'image_url' => '/images/products/pie-buah.jpg',
            ],
            [
                'name' => 'Kue Lumpur',
                'description' => 'Kue lumpur lembut dan manis',
                'price' => 2000,
                'stock' => 60,
                'category' => 'Kue',
                'image_url' => '/images/products/kue-lumpur.jpg',
            ],
            [
                'name' => 'Agar Agar Kertas',
                'description' => 'Agar agar segar dengan tekstur lembut',
                'price' => 2000,
                'stock' => 45,
                'category' => 'Kue',
                'image_url' => '/images/products/agar-agar-kertas.jpg',
            ],
            [
                'name' => 'Pepe Pelangi',
                'description' => 'Kue pepe dengan warna pelangi yang menarik',
                'price' => 2000,
                'stock' => 50,
                'category' => 'Kue',
                'image_url' => '/images/products/pepe-pelangi.jpg',
            ],
            [
                'name' => 'Putu Ayu',
                'description' => 'Kue putu ayu dengan kelapa parut',
                'price' => 2000,
                'stock' => 55,
                'category' => 'Kue',
                'image_url' => '/images/products/putu-ayu.jpg',
            ],
            [
                'name' => 'Pepe Hijau',
                'description' => 'Kue pepe hijau dengan aroma pandan',
                'price' => 2000,
                'stock' => 50,
                'category' => 'Kue',
                'image_url' => '/images/products/pepe-hijau.jpg',
            ],
            [
                'name' => 'Lemper',
                'description' => 'Lemper ayam gurih dengan ketan',
                'price' => 2000,
                'stock' => 60,
                'category' => 'Kue',
                'image_url' => '/images/products/lemper.jpg',
            ],
            [
                'name' => 'Kue Apem',
                'description' => 'Kue apem lembut tradisional',
                'price' => 2000,
                'stock' => 50,
                'category' => 'Kue',
                'image_url' => '/images/products/kue-apem.jpg',
            ],
            [
                'name' => 'Kue Talam Suji',
                'description' => 'Kue talam suji dengan santan',
                'price' => 2000,
                'stock' => 45,
                'category' => 'Kue',
                'image_url' => '/images/products/kue-talam-suji.jpg',
            ],
            [
                'name' => 'Dadar Gulung',
                'description' => 'Dadar gulung isi kelapa manis',
                'price' => 2000,
                'stock' => 55,
                'category' => 'Kue',
                'image_url' => '/images/products/dadar-gulung.jpg',
            ],
            [
                'name' => 'Risoles',
                'description' => 'Risoles isi sayuran dan daging',
                'price' => 2000,
                'stock' => 50,
                'category' => 'Kue',
                'image_url' => '/images/products/risoles.jpg',
            ],
            [
                'name' => 'Pie Brownies',
                'description' => 'Pie dengan isian brownies coklat',
                'price' => 2000,
                'stock' => 35,
                'category' => 'Kue',
                'image_url' => '/images/products/pie-brownies.jpg',
            ],
            [
                'name' => 'Talam Ubi',
                'description' => 'Kue talam ubi ungu yang lezat',
                'price' => 2000,
                'stock' => 45,
                'category' => 'Kue',
                'image_url' => '/images/products/talam-ubi.jpg',
            ],
            [
                'name' => 'Pastel',
                'description' => 'Pastel goreng isi sayuran',
                'price' => 2000,
                'stock' => 60,
                'category' => 'Kue',
                'image_url' => '/images/products/pastel.jpg',
            ],
            [
                'name' => 'Ongol Ongol',
                'description' => 'Ongol ongol kenyal dengan kelapa',
                'price' => 2000,
                'stock' => 45,
                'category' => 'Kue',
                'image_url' => '/images/products/ongol-ongol.jpeg',
            ],
            [
                'name' => 'Lupis',
                'description' => 'Lupis dengan gula merah dan kelapa',
                'price' => 2000,
                'stock' => 50,
                'category' => 'Kue',
                'image_url' => '/images/products/lupis.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
