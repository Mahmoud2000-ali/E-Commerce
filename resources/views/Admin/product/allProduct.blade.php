@extends('admin.layouts.template')
@section('page_title')
All Product
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
        Pages/</span> All Product</h4>
    <div class="card">
        <h5 class="card-header">Available All Product Information</h5>
        @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
                <tr>
                  <th>Id</th>
                  <th>Product Name</th>
                  <th>Product Price</th>
                  <th>Product Quantity</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <img style="height: 100px" src="{{ asset($product->product_image) }}" alt="ERROR"> <br>
                    <a href="{{ route('admin.editProductImage', $product->id) }}" class="btn btn-primary">Uplode Image</a>
                </td>
                <td>
                    <a href="{{ route('admin.editProduct', $product->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.deleteProduct', $product->id) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>
@endsection
