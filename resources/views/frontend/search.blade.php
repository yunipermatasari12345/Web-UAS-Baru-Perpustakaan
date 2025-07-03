@extends('layouts.app')

@section('title', 'Hasil Pencarian - Sistem Perpustakaan Digital')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">
                <i class="fas fa-search me-2"></i>Hasil Pencarian
            </h2>

            @if($query)
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan hasil pencarian untuk: <strong>"{{ $query }}"</strong>
                <span class="badge bg-primary ms-2">{{ $books->total() }} buku ditemukan</span>
            </div>
            @endif

            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('frontend.search') }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <input type="text" name="q" class="form-control"
                                   placeholder="Cari judul buku, penulis, atau ISBN..."
                                   value="{{ $query }}">
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
                        <i class="fas fa-search fa-2x mb-3"></i>
                        <h4>Tidak ada buku ditemukan</h4>
                        <p>Coba ubah kata kunci pencarian Anda atau <a href="{{ route('frontend.books') }}">lihat semua buku</a>.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $books->appends(['q' => $query])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
