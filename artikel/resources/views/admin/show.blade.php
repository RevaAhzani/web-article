@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <h3>Show Article</h3>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>{{ $article->title }}</h3><hr>

                    {!! $article->content !!}

                </div>
            </div>

            <!-- Komentar -->

            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <h3>Comments</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card mb-3">
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="">Send Comments</label>
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <input type="hidden" name="comment_id" value="">
                                    <textarea name="comment" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Submit</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    @foreach($article->comments as $comment)
                        @if($comment->comment_id === null)
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $comment->user->name }}
                            </div>
                            <div class="card-body">
                                {{ $comment->comment }}
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        {{ $comment->created_at }} 
                                    </div>
                                    <div class="col d-flex justify-content-end gap-3">
                                        <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#replyComment-{{ $comment->id }}">Reply</a>
                                        <div class="modal fade" id="replyComment-{{ $comment->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1>Reply Comment</h1>
                                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('comment.store') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="">Reply Comments</label>
                                                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                                <textarea name="comment" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @if(Auth::user()->roles[0]->name == 'Admin')
                                        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteComment-{{ $comment->id }}">Delete</a>
                                        <div class="modal fade" id="deleteComment-{{ $comment->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1>Delete Comment</h1>
                                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <h6>Are you sure you want to delete?</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @foreach($comment->comments as $reply)
                            <div class="card mb-3 ms-3">
                                <div class="card-header">
                                    {{ $reply->user->name }}
                                </div>
                                <div class="card-body">
                                    {{ $reply->comment }}
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            {{ $reply->created_at }} 
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            @if(Auth::user()->roles[0]->name == 'Admin')
                                                <a href="" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#deleteComment-{{ $reply->id }}">Delete</a>
                                                <div class="modal fade" id="deleteComment-{{ $reply->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1>Delete Comment</h1>
                                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form action="{{ route('comment.destroy', $reply->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <h6>Are you sure you want to delete?</h6>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
