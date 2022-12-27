<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $per_page = 25;
        $per_page = $request->input('per_page') ? $request->input('per_page') : "25";
        $products = Product::where('user_id', $user->id)->filter()->paginate($per_page);
        return Inertia::render('Product/Index', [
            'products' => $products,
            'sort' => $request->input('sort'),
            'where_any' => $request->input('where_any'),
            'per_page' => $per_page,
            'search' => $request->input('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
        ]);
        $product = new Product([
            'name' => $request->get('name'),
            'identification_code' => $request->get('identification_code'),
            'user_id' => $user->id,
        ]);
        $product->save();
        return redirect()->route('product.show', $product->hash);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        return Inertia::render('Product/Show', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hash)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if($product->user_id != $user->id) abort(403);
        $product->name = $request->get('name');
        $product->identification_code = $request->get('identification_code');
        $product->save();
        redirect()->back()->with('success','deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($hash)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if($product->user_id != $user->id) abort(403);
        $product->delete();
        redirect()->back()->with('success','deleted');
    }
}
