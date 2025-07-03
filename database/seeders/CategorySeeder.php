<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Buku-buku fiksi dan novel', 'icon' => 'test-icon.png'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku-buku non-fiksi dan referensi'],
            ['name' => 'Pendidikan', 'description' => 'Buku-buku pendidikan dan akademik', 'icon' => 'test-icon.png'],
            ['name' => 'Teknologi', 'description' => 'Buku-buku teknologi dan komputer'],
            ['name' => 'Bisnis', 'description' => 'Buku-buku bisnis dan ekonomi'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
