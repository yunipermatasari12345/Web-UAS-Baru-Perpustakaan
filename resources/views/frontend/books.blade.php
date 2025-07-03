@extends('layouts.app')

@section('title', 'Katalog Buku - Sistem Perpustakaan Digital')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Daftar Buku</h2>

            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('frontend.books') }}" class="row g-3">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" placeholder="Cari buku berdasarkan judul..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <a href="{{ route('frontend.books') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Books Grid -->
            <div class="row">
                @forelse($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="text-center p-3">
                                <img src="{{ $book->cover_image_url }}" alt="Cover {{ $book->title }}"
                                     class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text text-muted">oleh {{ $book->author }}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <strong>ISBN:</strong> {{ $book->isbn }}<br>
                                        <strong>Kategori:</strong> {{ $book->category->name }}<br>
                                        <strong>Penerbit:</strong> {{ $book->publisher->name }}<br>
                                        <strong>Stok:</strong>
                                        <span class="badge {{ $book->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $book->quantity }}
                                        </span>
                                    </small>
                                </p>
                                @if($book->description)
                                    <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                                @endif
                                <a href="{{ route('frontend.book.detail', $book->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Tidak ada buku yang ditemukan.
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
