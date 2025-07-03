<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'yuni_borrowings';

    protected $fillable = [
        'yuni_book_id',
        'yuni_member_id',
        'borrow_date',
        'return_date',
        'actual_return_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'actual_return_date' => 'date',
    ];

    /**
     * Get the book that owns the borrowing.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'yuni_book_id');
    }

    /**
     * Get the member that owns the borrowing.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'yuni_member_id');
    }
}
