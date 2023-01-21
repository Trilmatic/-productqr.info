<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

class BaseController extends Controller
{
    public function welcome()
    {
        $plans = Plan::select('id', 'name', 'slug', 'price')->get();
        $user = Auth::user();
        if ($user) $subscription = $user->subscriptions()->select('name')->first();
        else $subscription = null;
        return Inertia::render('Welcome', [
            'plans' => $plans,
            'subscription' => $subscription
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $subscription = $user->subscriptions()->select('name')->first();
        $products_count = $user->products()->count();
        $products = $user->products()->orderBy('updated_at', 'desc')->limit(10)->get();
        $invoices = $user->invoices()->take(5);
        $is_over_product_limit = $user->is_over_product_limit();
        $is_over_api_limit = $user->is_over_api_limit();
        $api_calls_count = $user->api_calls_count();
        $api_calls_count = $user->api_calls_count();
        return Inertia::render('Dashboard', [
            'subscription' => $subscription,
            'products_count' => $products_count,
            'invoices' => $invoices,
            'is_over_product_limit' => $is_over_product_limit,
            'is_over_api_limit' => $is_over_api_limit,
            'api_calls_count' => $api_calls_count,
            'products' => $products
        ]);
    }
}
