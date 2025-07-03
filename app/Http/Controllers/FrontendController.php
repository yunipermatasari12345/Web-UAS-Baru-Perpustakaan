<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'publisher'])->latest()->take(6)->get();
        $categories = Category::all();

        return view('frontend.index', compact('books', 'categories'));
    }

    public function books(Request $request)
    {
        $search = $request->get('search');

        $books = Book::with(['category', 'publisher']);

        if ($search) {
            $books = $books->where('title', 'like', "%{$search}%")
                          ->orWhere('author', 'like', "%{$search}%")
                          ->orWhere('isbn', 'like', "%{$search}%");
        }

        $books = $books->latest()->paginate(12);

        return view('frontend.books', compact('books', 'search'));
    }

    public function bookDetail($id)
    {
        $book = Book::with(['category', 'publisher'])->findOrFail($id);

        return view('frontend.book-detail', compact('book'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $books = Book::with(['category', 'publisher'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->orWhere('isbn', 'like', "%{$query}%")
            ->paginate(12);

        return view('frontend.search', compact('books', 'query'));
    }
}
