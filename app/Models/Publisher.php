<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'yuni_publishers';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    /**
     * Get the books for the publisher.
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'yuni_publisher_id');
    }
}
