<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;

class PlanController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function welcome()
    {
        $plans = Plan::all();
        return Inertia::render('Welcome', [
            'plans' => $plans
        ]);
    }

    public function index()
    {
        $plans = Plan::all();
        $user = Auth::user();
        return Inertia::render('Plan/Index', [
            'plans' => $plans
        ]);
    }

    public function show(Request $request, $slug)
    {
        $plan = Plan::where('slug', $slug)->first();
        if (!$plan) abort(404);
        $user = Auth::user();
        $paymentMethods = $request->user()->paymentMethods();
        $intent = $user->createSetupIntent();

        return Inertia::render('Plan/Show', [
            'plan' => $plan,
            'intent' => $intent,
            'stripe_key' => env('STRIPE_KEY')
        ]);
    }

    public function subscribe(Request $request, $slug)
    {
        $plan = Plan::where('slug', $slug)->first();
        if (!$plan) abort(404);
        $user = Auth::user();
        $paymentMethod = $request->paymentMethod;
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user->newSubscription($plan->name, $plan->stripe_plan)
            ->create($paymentMethod, [
                'email' => $user->email,
            ]);

        return redirect()->route('home')->with('success', 'Your plan subscribed successfully');
    }
}
