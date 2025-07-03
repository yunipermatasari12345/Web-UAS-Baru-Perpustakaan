@extends('layouts.app')

@section('title', $book->title . ' - Sistem Perpustakaan Digital')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('frontend.books') }}">Katalog Buku</a></li>
                    <li class="breadcrumb-item active">{{ $book->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $book->cover_image_url }}" alt="Cover {{ $book->title }}"
                         class="img-fluid rounded shadow" style="max-width: 100%; max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $book->title }}</h1>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">
                                <i class="fas fa-user me-2"></i><strong>Penulis:</strong>
                            </p>
                            <p class="mb-3">{{ $book->author }}</p>

                            <p class="text-muted mb-1">
                                <i class="fas fa-calendar me-2"></i><strong>Tahun Terbit:</strong>
                            </p>
                            <p class="mb-3">{{ $book->year_published }}</p>

                            <p class="text-muted mb-1">
                                <i class="fas fa-barcode me-2"></i><strong>ISBN:</strong>
                            </p>
                            <p class="mb-3">{{ $book->isbn }}</p>
                        </div>

                        <div class="col-md-6">
                            <p class="text-muted mb-1">
                                <i class="fas fa-folder me-2"></i><strong>Kategori:</strong>
                            </p>
                            <p class="mb-3">
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                            </p>

                            <p class="text-muted mb-1">
                                <i class="fas fa-building me-2"></i><strong>Penerbit:</strong>
                            </p>
                            <p class="mb-3">{{ $book->publisher->name }}</p>

                            <p class="text-muted mb-1">
                                <i class="fas fa-book me-2"></i><strong>Stok:</strong>
                            </p>
                            <p class="mb-3">
                                @if($book->quantity > 0)
                                    <span class="badge bg-success">{{ $book->quantity }} tersedia</span>
                                @else
                                    <span class="badge bg-danger">Tidak tersedia</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($book->description)
                    <div class="mb-4">
                        <h5>Deskripsi:</h5>
                        <p class="text-muted">{{ $book->description }}</p>
                    </div>
                    @endif

                    <div class="d-flex gap-2">
                        <a href="{{ route('frontend.books') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Katalog
                        </a>
                        @if($book->quantity > 0)
                            <button class="btn btn-primary" disabled>
                                <i class="fas fa-hand-holding me-2"></i>Pinjam Buku
                            </button>
                        @else
                            <button class="btn btn-secondary" disabled>
                                <i class="fas fa-times me-2"></i>Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Peminjaman
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Durasi Peminjaman:</strong> 7 hari
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Denda Keterlambatan:</strong> Rp 1.000/hari
                    </div>

                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Maksimal Peminjaman:</strong> 3 buku
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book me-2"></i>Buku Serupa
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Fitur ini akan menampilkan buku-buku serupa berdasarkan kategori.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
