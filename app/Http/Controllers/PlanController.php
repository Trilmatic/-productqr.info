<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BillingDetail;
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
        //$paymentMethods = $request->user()->paymentMethods();
        $intent = $user->createSetupIntent();

        return Inertia::render('Plan/Show', [
            'plan' => $plan,
            'intent' => $intent,
            'stripe_key' => env('STRIPE_KEY'),
            'billing_details' => $user->billing_details()->first()
        ]);
    }

    public function billing_details(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
        ]);
        $details = BillingDetail::where('user_id', $user->id)->first();
        if ($details) {
            $details->name = $request->get('name');
            $details->line1 = $request->get('line1');
            $details->line2 = $request->get('line2');
            $details->city = $request->get('city');
            $details->state = $request->get('state');
            $details->postal_code = $request->get('postal_code');
            $details->country = $request->get('country');
            $details->save();
        } else {
            $details = new BillingDetail([
                'name' => $request->get('name'),
                'line1' => $request->get('line1'),
                'line2' => $request->get('line2'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'postal_code' => $request->get('postal_code'),
                'country' => $request->get('country'),
                'user_id' => $user->id,
            ]);
            $details->save();
        }
        $options = [
            "name" => $details->name,
            "address" => [
                "line1" => $details->line1,
                "line2" => $details->line2,
                "city" => $details->city,
                "state" => $details->state,
                "postal_code" => $details->postal_code,
                "country" => $details->country,
            ],
        ];
        $user->createOrGetStripeCustomer();
        $user->updateStripeCustomer($options);
        redirect()->back()->with('success', 'saved');
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

        return redirect()->back()->with('success', 'Your plan subscribed successfully');
    }
}
