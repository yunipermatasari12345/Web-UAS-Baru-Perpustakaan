<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::withCount('books')->latest()->paginate(10);
        return view('admin.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Publisher::create($request->all());
        return redirect()->route('admin.publishers.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        $publisher->load('books');
        return view('admin.publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $publisher->update($request->all());
        return redirect()->route('admin.publishers.index')->with('success', 'Penerbit berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        if ($publisher->books()->count() > 0) {
            return redirect()->route('admin.publishers.index')->with('error', 'Penerbit tidak dapat dihapus karena masih memiliki buku');
        }

        $publisher->delete();
        return redirect()->route('admin.publishers.index')->with('success', 'Penerbit berhasil dihapus');
    }
}
