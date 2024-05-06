@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Manage Products</div>
        <div class="card-body">
            @can('create-product')
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                    Add New Product</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Main Image</th>
                        <th scope="col">Additional Images</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>

                            <td><img src="{{ $product->main_image  }}" alt="{{ $product->name }}" style="max-width: 100px;"></td>
                            
                            <td>
                                @foreach ($product->images as $image)
                                    <img src="{{ $image->path }}" alt="{{ $product->name }}" style="max-width: 100px; margin-bottom: 5px;">
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    {{-- @can('edit-product')
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @endcan --}}

                                    @can('delete-product')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Do you want to delete this product?');"><i
                                                class="bi bi-trash"></i> Delete</button>
                                    @endcan

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-danger">
                                <strong>No Product Found!</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $products->links() }}

        </div>
    </div>
@endsection
