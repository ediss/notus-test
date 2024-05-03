@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @canany(['create-user', 'edit-user', 'delete-user'])
                        <a class="btn btn-success" href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i> Manage Users</a>
                    @endcanany
                    @canany(['create-product', 'edit-product', 'delete-product'])
                        <a class="btn btn-warning" href="{{ route('products.index') }}">
                            <i class="bi bi-bag"></i> Manage Products</a>
                    @endcanany

                    @canany(['create-category', 'edit-category', 'delete-category'])
                        <a class="btn btn-danger" href="{{ route('categories.index') }}">
                            <i class="bi bi-tags"></i> Manage Categories</a>
                    @endcanany

                    {{-- @canany(['create-category', 'edit-category', 'delete-category'])
                        <a class="btn btn-primary" href="{{ route('categories.index') }}">
                            <i class="bi bi-person-fill-gear"></i> Manage Categories</a>
                    @endcanany

                    @canany(['create-comment', 'edit-comment', 'delete-comment'])
                        <a class="btn btn-primary" href="{{ route('comments.index') }}">
                            <i class="bi bi-person-fill-gear"></i> Manage Comments</a>
                    @endcanany --}}
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection