<?php

namespace App\Http\Controllers;

use App\Models\ProductInfo;
use App\Models\Product;
use App\Models\Language;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProductInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hash)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $languages = Language::all();
        return Inertia::render('ProductInfo/Create', [
            'product' => $product,
            'languages' => $languages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $hash)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $request->validate([
            'language_id' => 'required',
        ]);
        $infos = ProductInfo::where([['product_id', $product->id], ['default', true]])->get();
        $default = $infos ? false : true;
        $info = new ProductInfo([
            'language_id' => $request->get('language_id'),
            'product_id' => $product->id,
            'user_id' => $user->id,
            'content' => $request->get('content'),
            'default' => $default,
        ]);
        $info->save();
        return redirect()->route('product.info.show', $product->hash);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $hash)
    {
        $product = Product::with("product_infos", "product_infos.language")->where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($request->input('hash')) {
            $info = $product->request_info($request->input('hash'));
        } else {
            $info = $product->info()->first();
            if (!$info) $info = $product->product_infos()->first();
        }
       
        return Inertia::render('ProductInfo/Show', [
            'product' => $product,
            'info' => $info,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($hash, $hash2)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $info = ProductInfo::where('hash', $hash2)->first();
        if (!$info) abort(404);
        if ($user->id != $info->user_id) abort(403);
        $languages = Language::all();
        return Inertia::render('ProductInfo/Edit', [
            'product' => $product,
            'languages' => $languages,
            'info' => $info,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hash, $hash2)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $info = ProductInfo::where('hash', $hash2)->first();
        if (!$info) abort(404);
        if ($user->id != $info->user_id) abort(403);
        $request->validate([
            'language_id' => 'required',
        ]);
        $info->language_id = $request->get('language_id');
        $info->content = $request->get('content');
        $info->save();
        return redirect()->route('product.info.show', $product->hash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInfo $productInfo)
    {
        //
    }
}
