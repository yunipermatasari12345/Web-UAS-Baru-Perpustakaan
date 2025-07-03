<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowings = Borrowing::with(['book', 'member'])->latest()->paginate(10);
        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        $members = Member::all();
        return view('admin.borrowings.create', compact('books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
            'notes' => 'nullable|string',
        ]);

        // Check if book is available
        $book = Book::find($request->book_id);
        if ($book->stock <= 0) {
            return back()->withErrors(['book_id' => 'Buku tidak tersedia untuk dipinjam']);
        }

        // Create borrowing
        $borrowing = Borrowing::create($request->all());

        // Decrease book stock
        $book->decrement('stock');

        return redirect()->route('admin.borrowings.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['book', 'member']);
        return view('admin.borrowings.show', compact('borrowing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        $books = Book::all();
        $members = Member::all();
        return view('admin.borrowings.edit', compact('borrowing', 'books', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
            'actual_return_date' => 'nullable|date|after_or_equal:borrow_date',
            'status' => 'required|in:borrowed,returned,overdue',
            'notes' => 'nullable|string',
        ]);

        $oldBookId = $borrowing->book_id;
        $newBookId = $request->book_id;

        // Update borrowing
        $borrowing->update($request->all());

        // Handle book stock changes
        if ($oldBookId != $newBookId) {
            // Return stock to old book
            Book::find($oldBookId)->increment('stock');
            // Decrease stock from new book
            Book::find($newBookId)->decrement('stock');
        }

        // If status changed to returned, increase book stock
        if ($request->status === 'returned' && $borrowing->getOriginal('status') !== 'returned') {
            Book::find($newBookId)->increment('stock');
        }

        return redirect()->route('admin.borrowings.index')->with('success', 'Peminjaman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        // Return book stock if not returned
        if ($borrowing->status !== 'returned') {
            $borrowing->book->increment('stock');
        }

        $borrowing->delete();
        return redirect()->route('admin.borrowings.index')->with('success', 'Peminjaman berhasil dihapus');
    }

    /**
     * Return book
     */
    public function returnBook(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'returned',
            'actual_return_date' => Carbon::now(),
        ]);

        // Increase book stock
        $borrowing->book->increment('stock');

        return redirect()->route('admin.borrowings.index')->with('success', 'Buku berhasil dikembalikan');
    }
}
