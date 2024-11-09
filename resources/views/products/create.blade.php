@extends('app')
@section('content')
    <div class="container mt-5">
        <div class="row align-center justify-content-center">
            <div class="col-xl-12">
                <h1 class="float-start me-2">Products</h1>
                <div class="float-end mt-2"><a href="/products" class="btn btn-sm btn-danger">Back</a></div>
                <div class="clearfix mb-3"></div>
                <form action="/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="id" class="form-label">Product ID</label>
                        <input type="text" class="form-control" id="product_id" name="product_id" value="{{old('product_id')}}">
                        @if($errors->has('product_id'))
                            <span class="text-danger">{{$errors->first('product_id')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}">
                        @if($errors->has('price'))
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock" value="{{old('stock')}}">
                        @if($errors->has('stock'))
                            <span class="text-danger">{{$errors->first('stock')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
