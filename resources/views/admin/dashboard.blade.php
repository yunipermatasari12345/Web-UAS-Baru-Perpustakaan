@extends('layouts.app')

@section('title', 'Dashboard Admin - Sistem Perpustakaan Digital')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard Admin
            </h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ $totalBooks }}</h4>
                            <p class="card-text">Total Buku</p>
                        </div>
                        <div>
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ $totalMembers }}</h4>
                            <p class="card-text">Total Anggota</p>
                        </div>
                        <div>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ $activeBorrowings }}</h4>
                            <p class="card-text">Sedang Dipinjam</p>
                        </div>
                        <div>
                            <i class="fas fa-hand-holding fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ $overdueBorrowings }}</h4>
                            <p class="card-text">Terlambat</p>
                        </div>
                        <div>
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Borrowings -->
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Peminjaman Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Buku</th>
                                    <th>Anggota</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBorrowings as $borrowing)
                                <tr>
                                    <td>{{ $borrowing->book->title }}</td>
                                    <td>{{ $borrowing->member->name }}</td>
                                    <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                    <td>
                                        @if($borrowing->status === 'borrowed')
                                            <span class="badge bg-info">Dipinjam</span>
                                        @elseif($borrowing->status === 'returned')
                                            <span class="badge bg-success">Dikembalikan</span>
                                        @else
                                            <span class="badge bg-warning">Terlambat</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada peminjaman terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books by Category -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>
                        Buku per Kategori
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($booksByCategory as $category)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>{{ $category->name }}</span>
                        <span class="badge bg-primary">{{ $category->books_count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.books.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>Tambah Buku
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.members.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-user-plus me-2"></i>Tambah Anggota
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.borrowings.create') }}" class="btn btn-info w-100">
                                <i class="fas fa-hand-holding me-2"></i>Peminjaman Baru
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-warning w-100">
                                <i class="fas fa-folder-plus me-2"></i>Tambah Kategori
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
