@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                <tr>
                                    <td><img src="{{ $product->image }}" alt="{{ $product->name }}" height="80px"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-default">Edit</a>
                                        <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach    
                            @else 
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <strong>No products added. Create products <a href="{{ route('product.create') }}">here</a>.</strong>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
