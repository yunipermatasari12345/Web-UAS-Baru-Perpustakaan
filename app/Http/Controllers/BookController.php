<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['category', 'publisher'])->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.create', compact('categories', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:yuni_books,isbn',
            'description' => 'nullable|string',
            'year_published' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'quantity' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'yuni_category_id' => 'required|exists:yuni_categories,id',
            'yuni_publisher_id' => 'required|exists:yuni_publishers,id',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('cover_image')) {
            Log::info('Upload file detected');
            $image = $request->file('cover_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $result = $image->storeAs('public/covers', $imageName);
            Log::info('File stored as: ' . $imageName . ' | Result: ' . $result);
            $data['cover_image'] = $imageName;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load(['category', 'publisher']);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.edit', compact('book', 'categories', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:yuni_books,isbn,' . $book->id,
            'description' => 'nullable|string',
            'year_published' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'quantity' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'yuni_category_id' => 'required|exists:yuni_categories,id',
            'yuni_publisher_id' => 'required|exists:yuni_publishers,id',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('cover_image')) {
            Log::info('Upload file detected');
            $image = $request->file('cover_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $result = $image->storeAs('public/covers', $imageName);
            Log::info('File stored as: ' . $imageName . ' | Result: ' . $result);
            $data['cover_image'] = $imageName;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Delete cover image if exists
        if ($book->cover_image) {
            Storage::delete('public/covers/' . $book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
