<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = [
            [
                'name' => 'Gramedia Pustaka Utama',
                'address' => 'Jakarta, Indonesia',
                'phone' => '021-1234567',
                'email' => 'info@gramedia.com',
            ],
            [
                'name' => 'Erlangga',
                'address' => 'Jakarta, Indonesia',
                'phone' => '021-2345678',
                'email' => 'info@erlangga.co.id',
            ],
            [
                'name' => 'Penerbit Andi',
                'address' => 'Yogyakarta, Indonesia',
                'phone' => '0274-3456789',
                'email' => 'info@penerbitandi.com',
            ],
            [
                'name' => 'Mizan Pustaka',
                'address' => 'Jl. Cinambo 135, Bandung',
                'phone' => '022-7803933',
                'email' => 'info@mizan.com',
            ],
            [
                'name' => 'Penerbit Informatika',
                'address' => 'Jl. Buah Batu No. 40, Bandung',
                'phone' => '022-7208300',
                'email' => 'info@informatika.org',
            ],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}
