<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'yuni_books';

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'year_published',
        'quantity',
        'cover_image',
        'yuni_category_id',
        'yuni_publisher_id',
    ];

    protected $casts = [
        'year_published' => 'integer',
        'quantity' => 'integer',
    ];

    /**
     * Get the category that owns the book.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'yuni_category_id');
    }

    /**
     * Get the publisher that owns the book.
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'yuni_publisher_id');
    }

    /**
     * Get the borrowings for the book.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'yuni_book_id');
    }

    // Accessor untuk mendapatkan URL cover image
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('storage/covers/' . $this->cover_image);
        }
        // Return SVG placeholder sebagai data URI
        return 'data:image/svg+xml;base64,' . base64_encode('
            <svg width="200" height="300" xmlns="http://www.w3.org/2000/svg">
                <rect width="200" height="300" fill="url(#gradient)"/>
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#007bff;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#28a745;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <text x="100" y="150" font-family="Arial, sans-serif" font-size="16" fill="white" text-anchor="middle">Default Cover</text>
            </svg>
        ');
    }
}
