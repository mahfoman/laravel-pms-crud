<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    // create index listing products with pagination and with search filter product_id and description
    public function index(Request $request)
    {
        $orderColumn = request('order_column', 'name');

        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        $products = Product::where('product_id', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->orderBy( $orderColumn, $orderDirection )
            ->paginate(10);
        return view('products.index', compact('products','orderDirection', 'orderColumn'));
    }

    // create new product
    public function create()
    {
        return view('products.create');
    }

    // store new product
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'string', 'unique:products,product_id'],
            'name' => 'required|string|max:100',
            //'description' => 'required',
            'price' => 'required|decimal:2',
            'stock' => 'nullable|integer',
            //'image' => 'required',
        ]);

        //image upload
        if ( $request->file('image') ) {
            $fileName = $request->file( 'image' )->getClientOriginalName();
            $request->file('image')->move(public_path('/product_images'), $fileName);
            $request->image = $fileName;
        }

        Product::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image
        ]);

        return redirect('/products')->with('success', 'Product created successfully.');
    }

    public function edit($productId)
    {
//        dd($productId);
        $product = Product::find($productId);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $productId){

        $product = Product::find($productId);

        $request->validate([
            'product_id' => ['required', 'string'],
            'name' => 'required|string|max:100',
            //'description' => 'required',
            'price' => 'required|decimal:2',
            'stock' => 'nullable|integer',
            //'image' => 'required',
        ]);

        $fileName = null;
        //image upload
        if ( $request->file( 'image' ) ) { //dd($request->file('image'));
            $fileName = $request->file( 'image' )->getClientOriginalName();
            $request->file('image')->move(public_path('/product_images'), $fileName);
            //dd($fileName);
        }
        $request->image = $fileName ?? $product->image;

        $product->update([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image
        ]);
        return redirect('/products/'.$productId.'/edit')->with('success', 'Product updated successfully.');
    }

    public function destroy($id){
        $product = Product::find($id);
        if (file_exists(public_path('product_images/' . $product->image))) {
            File::delete(public_path('product_images/' . $product->image));
        }
        $product->delete();
        return redirect('/products')->with('success', 'Product deleted successfully.');
    }
}
