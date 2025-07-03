@extends('layouts.app')

@section('title', 'Beranda - Sistem Perpustakaan Digital')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">Selamat Datang di Perpustakaan Digital</h1>
                <p class="lead mb-4">Temukan ribuan buku berkualitas untuk memperluas pengetahuan Anda. Akses mudah, kapan saja dan di mana saja.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('frontend.books') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-search me-2"></i>Jelajahi Katalog
                    </a>
                    <a href="#featured-books" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-book me-2"></i>Buku Terbaru
                    </a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <i class="fas fa-book-open" style="font-size: 200px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('frontend.search') }}" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control form-control-lg me-2" placeholder="Cari judul buku, penulis, atau ISBN...">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Featured Books -->
<section id="featured-books" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">Buku Terbaru</h2>
            </div>
        </div>
        <div class="row">
            @foreach($books as $book)
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
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('frontend.books') }}" class="btn btn-primary">Lihat Semua Buku</a>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">Kategori Buku</h2>
            </div>
        </div>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ $category->icon_url }}" alt="Icon {{ $category->name }}"
                             class="img-fluid mb-3" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
