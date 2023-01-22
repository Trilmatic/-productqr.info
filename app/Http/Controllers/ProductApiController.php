<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductApiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if(!$user->tokenCan('read') || !$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $products = Product::where('user_id', $user->id)->filter();
        if($request->input('limit')) $products = $products->limit($request->input('limit'));
        $products = $products->get();
        $user->call_api();
        return response()->json($products);
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
        if(!$user->tokenCan('create') || !$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $request->validate([
            'name' => 'required',
        ]);
        $product = new Product([
            'name' => $request->get('name'),
            'identification_code' => $request->get('identification_code'),
            'user_id' => $user->id,
        ]);
        $product->save();
        $threshold = $user->threshold()->first();
        $count = $user->products()->count();
        if ($count === $threshold->basic_threshold_limit) $threshold->basic_threshold_id = $product->id;
        if ($count === $threshold->pro_threshold_limit) $threshold->pro_threshold_id = $product->id;
        $threshold->save();
        $user->call_api();
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $user = Auth::user();
        if(!$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $product = Product::where('hash', $hash)->first();
        if (!$product) return response('Not Found', 404);
        if($user->cannot('read', $product)) return response('Forbidden', 403);
        $user->call_api();
        return response()->json($product);
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
        if(!$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $request->validate([
            'name' => 'required',
        ]);
        $product = Product::where('hash', $hash)->first();
        if (!$product) return response('Not Found', 404);
        if($user->cannot('update', $product)) return response('Forbidden', 403);
        $product->name = $request->get('name');
        $product->identification_code = $request->get('identification_code');
        $product->save();
        $user->call_api();
        return response()->json($product);
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
        if(!$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $product = Product::where('hash', $hash)->first();
        if (!$product) return response('Not Found', 404);
        if($user->cannot('delete', $product)) return response('Forbidden', 403);
        $product->delete();
        $user->call_api();
        return response('Success');
    }
}
