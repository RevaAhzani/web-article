@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <h4>Articles</h4>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="" class="btn btn-primary">Create +</a>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.update', $article->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="{{ $article->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id }}" {{ $article->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="content">Content</label>
                            <textarea id="summernote" class="form-control" id="content" name="content" placeholder="Enter content" required>
                                {{ $article->content }}
                            </textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
      $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
@endsection