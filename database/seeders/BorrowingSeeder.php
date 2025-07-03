<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Borrowing;

class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $borrowings = [
            [
                'yuni_book_id' => 1,
                'yuni_member_id' => 1,
                'borrow_date' => '2024-01-15',
                'return_date' => '2024-02-15',
                'actual_return_date' => '2024-02-10',
                'status' => 'returned',
                'notes' => 'Buku dikembalikan tepat waktu',
            ],
            [
                'yuni_book_id' => 2,
                'yuni_member_id' => 2,
                'borrow_date' => '2024-01-20',
                'return_date' => '2024-02-20',
                'actual_return_date' => null,
                'status' => 'borrowed',
                'notes' => 'Masih dalam peminjaman',
            ],
            [
                'yuni_book_id' => 3,
                'yuni_member_id' => 3,
                'borrow_date' => '2024-01-10',
                'return_date' => '2024-02-10',
                'actual_return_date' => null,
                'status' => 'overdue',
                'notes' => 'Terlambat mengembalikan',
            ],
            [
                'yuni_book_id' => 4,
                'yuni_member_id' => 4,
                'borrow_date' => '2024-01-25',
                'return_date' => '2024-02-01',
                'actual_return_date' => null,
                'status' => 'borrowed',
                'notes' => 'Masih dipinjam',
            ],
            [
                'yuni_book_id' => 5,
                'yuni_member_id' => 5,
                'borrow_date' => '2024-01-18',
                'return_date' => '2024-01-25',
                'actual_return_date' => '2024-01-23',
                'status' => 'returned',
                'notes' => 'Buku dikembalikan lebih awal',
            ],
        ];

        foreach ($borrowings as $borrowing) {
            Borrowing::create($borrowing);
        }
    }
}
