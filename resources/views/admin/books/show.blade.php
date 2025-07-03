@extends('layouts.app')

@section('title', 'Detail Buku - Admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Buku</h4>
                    <div>
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="{{ $book->cover_image_url }}" alt="Cover {{ $book->title }}"
                                     class="img-fluid rounded shadow" style="max-width: 300px; max-height: 400px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $book->title }}</h3>
                            <p class="text-muted">oleh {{ $book->author }}</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>ISBN:</strong></td>
                                            <td>{{ $book->isbn }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tahun Terbit:</strong></td>
                                            <td>{{ $book->year_published }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kategori:</strong></td>
                                            <td>{{ $book->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Penerbit:</strong></td>
                                            <td>{{ $book->publisher->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stok:</strong></td>
                                            <td>
                                                <span class="badge {{ $book->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $book->quantity }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            @if($book->description)
                                <div class="mt-3">
                                    <h5>Deskripsi:</h5>
                                    <p>{{ $book->description }}</p>
                                </div>
                            @endif

                            <div class="mt-4">
                                <h5>Informasi Penerbit:</h5>
                                <p><strong>Nama:</strong> {{ $book->publisher->name }}</p>
                                @if($book->publisher->address)
                                    <p><strong>Alamat:</strong> {{ $book->publisher->address }}</p>
                                @endif
                                @if($book->publisher->phone)
                                    <p><strong>Telepon:</strong> {{ $book->publisher->phone }}</p>
                                @endif
                                @if($book->publisher->email)
                                    <p><strong>Email:</strong> {{ $book->publisher->email }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
