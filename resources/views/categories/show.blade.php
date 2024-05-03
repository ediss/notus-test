@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Category Information
                </div>
                <div class="float-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $category->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                 
                    </div>

                    @if($category->parent)
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Parent:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">

                            <a href="{{ route('categories.show', $category->parent->id) }}">

                                {{ $category->parent->name }}
                            </a> 
                            
                        </div>
                    </div>
                    @endif


                    @if($category->children->isNotEmpty())

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Children:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <ul>
                                @foreach ($category->children as $child)
                                    <li>{{ $child->name }}</li>
                                    @if ($child->children->isNotEmpty())
                                        @include('categories.partials.category-children', ['categories' => $child->children])
                                    @endif
                                @endforeach
                            </ul>
                            
                        </div>
                    </div>

                    @endif
            </div>
        </div>
    </div>
</div>    
@endsection