@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9 d-flex align-items-center">
                            <h4>Articles</h4>
                        </div>
                        <div class="col-3">
                            <form action="{{ route('member.index') }}" method="GET">
                                <select class="form-select" name="category_id" onchange="this.form.submit()">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @forelse ($articles as $article)
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>{{ $article->title }}</h4>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('member.show', $article->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    @empty
                        <p>Artikel tidak ditemukan di dalam kategori ini</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection