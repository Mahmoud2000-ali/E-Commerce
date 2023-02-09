@extends('admin.layouts.template')
@section('page_title')
    Edit Product
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Pages/</span> Edit Product</h4>

        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Product</h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.Update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $products->id }}" name="id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    value="{{ $products->product_name }}"
                                    class="@error('product_name') is-invalid @enderror" />
                                @error('product_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $products->price }}" class="@error('price') is-invalid @enderror" />
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    value="{{ $products->quantity }}" class="@error('quantity') is-invalid @enderror" />
                                @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Short
                                Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="product_short_des" id="product_short_des" cols="10" rows="3"
                                    class="@error('product_short_des') is-invalid @enderror">
                                    {{$products->product_short_des}}
                                </textarea>
                                @error('product_short_des')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Long Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="product_long_des" id="product_long_des" cols="10" rows="3"
                                    class="@error('product_short_des') is-invalid @enderror">
                                    {{  $products->product_long_des}}
                            </textarea>
                                @error('product_short_des')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
