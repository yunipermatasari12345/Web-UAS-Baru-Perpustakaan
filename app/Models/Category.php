<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'yuni_categories';

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    /**
     * Get the books for the category.
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'yuni_category_id');
    }

    // Accessor untuk mendapatkan URL icon
    public function getIconUrlAttribute()
    {
        if ($this->icon) {
            return asset('storage/category-icons/' . $this->icon);
        }
        // Return SVG placeholder sebagai data URI
        return 'data:image/svg+xml;base64,' . base64_encode('
            <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg">
                <circle cx="25" cy="25" r="25" fill="url(#gradient)"/>
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#ffc107;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#fd7e14;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <text x="25" y="30" font-family="Arial, sans-serif" font-size="10" fill="white" text-anchor="middle" font-weight="bold">ICON</text>
            </svg>
        ');
    }
}
