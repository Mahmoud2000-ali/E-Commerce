@extends('admin.layouts.template')
@section('page_title')
    All Sub Category
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Pages/</span> All Sub Category</h4>
        <div class="card">
            <h5 class="card-header">Available Sub Category Information</h5>
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
                            <th>Sub Category Name</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($allSubCategories as $subCategory)
                        <tr>
                            <td>{{ $subCategory->id }}</td>
                            <td>{{ $subCategory->subcategory_name }}</td>
                            <td>{{ $subCategory->category_name }}</td>
                            <td>{{ $subCategory->product_count }}</td>
                            <td>
                                <a href="{{ route('admin.editSubCategory', $subCategory->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('DeleteSubCategory', $subCategory->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
