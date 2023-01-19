<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Exceptions\IncompletePayment;
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
        $plans = Plan::select('id', 'name', 'slug', 'price')->get();
        $user = Auth::user();
        if ($user) $subscription = $user->subscriptions()->select('name')->first();
        else $subscription = null;
        return Inertia::render('Welcome', [
            'plans' => $plans,
            'subscription' => $subscription
        ]);
    }

    public function index()
    {
        $plans = Plan::select('id', 'name', 'slug', 'price')->get();
        $user = Auth::user();
        if ($user) $subscription = $user->subscriptions()->first();
        else $subscription = null;
        return Inertia::render('Plan/Index', [
            'plans' => $plans,
            'subscription' => $subscription
        ]);
    }

    public function show(Request $request, $slug)
    {
        $plan = Plan::select('id', 'name', 'slug', 'price')->where('slug', $slug)->first();
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
            "email" => $user->email,
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
        redirect()->back()->with('success', 'updated');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan' => 'required',
            'payment_method' => 'required',
        ]);
        $plan = Plan::where('id', $request->get('plan'))->first();
        if (!$plan) abort(404);
        $user = Auth::user();
        $payment_method = $request->get('payment_method');
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($payment_method);
        try {
            $user->newSubscription($plan->slug, $plan->stripe_plan)
                ->create($payment_method);
        } catch (IncompletePayment $exception) {
            return redirect()->route('subscription.cancel-page')->with('error', 'Payment failed');
        }

        return redirect()->route('subscription.success-page')->with('success', 'Your plan subscribed successfully');
    }

    public function payment_method_delete(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);
        $user = Auth::user();
        $user->createOrGetStripeCustomer();
        $payment_method = $request->get('payment_method');
        $user->deletePaymentMethod($payment_method);
        redirect()->back()->with('success', 'updated');
    }

    public function payment_method_update(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);
        $user = Auth::user();
        $user->createOrGetStripeCustomer();
        $payment_method = $request->get('payment_method');
        $user->updateDefaultPaymentMethod($payment_method);
        redirect()->back()->with('success', 'deleted');
    }

    public function cancel(Request $request)
    {
        $user = Auth::user();
        $subscriptions = $user->subscriptions()->active()->get();
        foreach ($subscriptions as $subscription) {
            $subscription->cancel();
        }
        redirect()->back()->with('success', 'canceled');
    }

    public function change(Request $request)
    {
        $request->validate([
            'plan' => 'required',
        ]);
        $plan = Plan::where('id', $request->get('plan'))->first();
        if (!$plan) abort(404);
        $user = Auth::user();
        $subscription = $user->subscriptions()->first();
        try {
            $user->subscription($subscription->name)->swap($plan->stripe_plan)->update(['name' => $plan->slug]);
        } catch (IncompletePayment $exception) {
            return redirect()->route('subscription.cancel-page')->with('error', 'Payment failed');
        }
        return redirect()->route('subscription.success-page')->with('success', 'Your plan subscription changed successfully');
    }

    public function success_page()
    {
        return Inertia::render('Plan/Success');
    }

    public function cancel_page()
    {
        return Inertia::render('Plan/Cancel');
    }

    public function upgrade_page()
    {
        return Inertia::render('Plan/Upgrade');
    }

    public function payments_page()
    {
        $user = Auth::user();
        $invoices = $user->invoices();
        return Inertia::render('Plan/Payments', [
            'invoices' => $invoices
        ]);
    }

    public function change_page()
    {
        $plans = Plan::select('id', 'name', 'slug', 'price')->get();
        $user = Auth::user();
        $subscription = $user->subscriptions()->select('name')->first();
        return Inertia::render('Plan/Change', [
            'plans' => $plans,
            'subscription' => $subscription
        ]);
    }
}
