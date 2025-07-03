<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $totalBorrowings = Borrowing::count();
        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();
        $overdueBorrowings = Borrowing::where('status', 'overdue')->count();

        $recentBorrowings = Borrowing::with(['book', 'member'])
            ->latest()
            ->take(5)
            ->get();

        $booksByCategory = Category::withCount('books')->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalMembers',
            'totalBorrowings',
            'activeBorrowings',
            'overdueBorrowings',
            'recentBorrowings',
            'booksByCategory'
        ));
    }
}
