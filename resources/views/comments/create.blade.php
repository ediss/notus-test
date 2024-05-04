@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Comment for {{ $product->name }}
                </div>
                <div class="float-end">
                    <a href="" class="btn btn-primary btn-sm">&larr; Back to Product</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf

                    <!-- Hidden Field for Product ID -->
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3 row">
                        <label for="content" class="col-md-4 col-form-label text-md-end text-start">Content</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="rating" class="col-md-4 col-form-label text-md-end text-start">Rating</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ old('rating') }}">
                            @error('rating')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Comment">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>    
@endsection
