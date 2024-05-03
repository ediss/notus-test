@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Category
                </div>
                <div class="float-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="parent_id" class="col-md-4 col-form-label text-md-end text-start">Parent Category</label>
                        <div class="col-md-6">
                          <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                            <option value="">No Parent</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                            @endforeach
                          </select>
                            @if ($errors->has('parent_id'))
                                <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Category">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>    
@endsection
