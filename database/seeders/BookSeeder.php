<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laravel: From Zero to Hero',
                'author' => 'John Doe',
                'isbn' => '978-1234567890',
                'description' => 'Panduan lengkap belajar Laravel dari dasar hingga mahir',
                'year_published' => 2023,
                'quantity' => 10,
                'cover_image' => 'test-cover.jpg',
                'yuni_category_id' => 3,
                'yuni_publisher_id' => 1,
            ],
            [
                'title' => 'PHP Programming',
                'author' => 'Jane Smith',
                'isbn' => '978-0987654321',
                'description' => 'Buku panduan pemrograman PHP untuk pemula',
                'year_published' => 2022,
                'quantity' => 15,
                'yuni_category_id' => 3,
                'yuni_publisher_id' => 2,
            ],
            [
                'title' => 'Database Design',
                'author' => 'Mike Johnson',
                'isbn' => '978-1122334455',
                'description' => 'Konsep dan implementasi desain database',
                'year_published' => 2023,
                'quantity' => 8,
                'yuni_category_id' => 4,
                'yuni_publisher_id' => 3,
            ],
            [
                'title' => 'Web Development',
                'author' => 'Sarah Wilson',
                'isbn' => '978-5566778899',
                'description' => 'Pengembangan web modern dengan HTML, CSS, dan JavaScript',
                'year_published' => 2022,
                'quantity' => 12,
                'yuni_category_id' => 4,
                'yuni_publisher_id' => 1,
            ],
            [
                'title' => 'Business Strategy',
                'author' => 'David Brown',
                'isbn' => '978-9988776655',
                'description' => 'Strategi bisnis untuk perusahaan modern',
                'year_published' => 2023,
                'quantity' => 6,
                'yuni_category_id' => 5,
                'yuni_publisher_id' => 2,
            ],
            [
                'title' => 'Novel Terbaik',
                'author' => 'Ahmad Tohari',
                'isbn' => '978-1122334456',
                'description' => 'Novel fiksi terbaik tahun ini',
                'year_published' => 2023,
                'quantity' => 20,
                'yuni_category_id' => 1,
                'yuni_publisher_id' => 1,
            ],
            [
                'title' => 'Sejarah Indonesia',
                'author' => 'Prof. Soekarno',
                'isbn' => '978-1122334457',
                'description' => 'Buku sejarah Indonesia lengkap',
                'year_published' => 2022,
                'quantity' => 10,
                'yuni_category_id' => 2,
                'yuni_publisher_id' => 2,
            ],
            [
                'title' => 'Matematika Dasar',
                'author' => 'Dr. Matematika',
                'isbn' => '978-1122334458',
                'description' => 'Buku matematika untuk SMA',
                'year_published' => 2023,
                'quantity' => 25,
                'yuni_category_id' => 3,
                'yuni_publisher_id' => 3,
            ],
            [
                'title' => 'Artificial Intelligence',
                'author' => 'AI Expert',
                'isbn' => '978-1122334459',
                'description' => 'Pengenalan AI dan machine learning',
                'year_published' => 2023,
                'quantity' => 8,
                'yuni_category_id' => 4,
                'yuni_publisher_id' => 1,
            ],
            [
                'title' => 'Marketing Digital',
                'author' => 'Digital Marketer',
                'isbn' => '978-1122334460',
                'description' => 'Strategi marketing di era digital',
                'year_published' => 2022,
                'quantity' => 12,
                'yuni_category_id' => 5,
                'yuni_publisher_id' => 2,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
