@extends('app')
@section('content')
    <div class="container mt-5">
        <div class="row align-center justify-content-center">
            <div class="col-xl-12">
                @include('flash-message')
                <h1 class="float-start me-2">Products</h1>
                <div class="float-end mt-2"><a href="/products/create" class="btn btn-sm btn-primary">Create</a></div>
                <table class="table table-striped mt-3">
                    <tr>
                        <th>
                            Product ID
                        </th>
                        <th>
                            <a class="text-dark" href="/products?order_column=name&order_direction={{ ($orderDirection == 'desc') ? 'asc' : 'desc' }}">
                                Name {!!  ( ( $orderColumn == 'name' ) && ( $orderDirection !== '' ) ) ? ( ($orderDirection == 'desc') ? '&uarr;' : '&darr;' ) : '' !!}
                            </a>
                        </th>
                        <th>
                            <a class="text-dark" href="/products?order_column=price&order_direction={{ ($orderDirection == 'desc') ? 'asc' : 'desc' }}">
                                Price {!!  ( ( $orderColumn == 'price' ) && ( $orderDirection !== '' ) ) ? ( ($orderDirection == 'desc') ? '&uarr;' : '&darr;' ) : '' !!}
                            </a>
                        </th>
                        <th>
                            Stock
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                    @forelse ($products as $product )
                        <tr>
                            <td>
                                {{ $product->product_id }}
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ number_format($product->price,2) }}
                            </td>
                            <td>
                                {{ $product->stock }}
                            </td>
                            <td>
                                <img src="{{  (isset($product->image)) ? asset('/product_images/'.$product->image) :'/img/no-image.jpg' }}" alt="" style="width:100px;" class="">
                            </td>
                            <td>
                                <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                <form action="/products/{{ $product->id }}" method="POST" class="d-inline-block resource-delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No product found
                            </td>
                        </tr>
                    @endforelse
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>

@endsection
