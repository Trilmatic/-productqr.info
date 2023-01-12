<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SitemapController extends Controller
{

    public function index()
    {
        $products = Product::select('hash', 'updated_at')->get();
        return response()->view('sitemap', ['products' => $products])->header('Content-Type', 'text/xml');
    }
}
