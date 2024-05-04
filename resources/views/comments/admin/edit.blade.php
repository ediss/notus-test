@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Comment
                </div>
                <div class="float-end">
                    <a href="{{ route('comments.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('comments.update', $comment->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 row">
                        <label for="content" class="col-md-4 col-form-label text-md-end text-start">Content</label>
                        <div class="col-md-6">
                          <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $comment->content) }}</textarea>
                            @if ($errors->has('content'))
                                <span class="text-danger">{{ $errors->first('content') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="rating" class="col-md-4 col-form-label text-md-end text-start">Rating</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ old('rating', $comment->rating) }}">
                            @if ($errors->has('rating'))
                                <span class="text-danger">{{ $errors->first('rating') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Comment">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>    
@endsection
