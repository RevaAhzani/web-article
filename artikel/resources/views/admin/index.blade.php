@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-7 d-flex align-items-center">
                            <h4>Articles</h4>
                        </div>
                        <div class="col-5 d-flex justify-content-end gap-3">
                            <form action="{{ route('admin.index') }}" method="GET">
                                <select class="form-select" name="category_id" onchange="this.form.submit()">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <a href="{{ route('admin.create') }}" class="btn btn-primary" style="display: inline;">Create +</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse ($articles as $article)
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>{{ $article->title }}</h4>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('admin.show', $article->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <a href="{{ route('admin.edit', $article->id) }}" method="POST" class="btn btn-warning">Edit</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('admin.destroy', $article->id) }}" method="POST"  style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Artikel tidak ditemukan di dalam kategori ini</p>
                    @endforelse

                    <!-- @foreach ($articles as $article)
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $article->title }}
                            </div>
                            <div class="card-body"> -->
                                <!-- tombol read more  -->
                                <!-- <a href="{{ route('admin.show', $article->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <a href="{{ route('admin.edit', $article->id) }}" method="POST" class="btn btn-warning">Edit</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('admin.destroy', $article->id) }}" method="POST"  style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
