@extends('admin.layouts.template')
@section('page_title')
    Edit Product Image
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Pages/</span> Edit Product Image</h4>

        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Add New Image</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.UpdateImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label"
                            for="basic-default-name">Previous Image</label>
                            <div class="col-sm-10">
                                <img src="{{ asset($productInfo->product_image) }}" alt="ERROR">
                            </div>
                        </div>

                        <input type="hidden" value="{{ $productInfo->id }}" name="id">

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label"
                            for="basic-default-name">Upload New Image</label>
                            <input class="form-control" type="file" id="product_image" name="product_image" />
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Product image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
