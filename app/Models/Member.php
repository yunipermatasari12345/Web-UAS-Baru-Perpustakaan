<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'yuni_members';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'birth_date',
        'member_code',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the borrowings for the member.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'yuni_member_id');
    }
}
