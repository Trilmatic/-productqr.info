<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic',
                'slug' => 'basic-monthly',
                'stripe_plan' => env('STRIPE_BASIC_MONTHLY'),
                'price' => 15,
            ],
            [
                'name' => 'Basic',
                'slug' => 'basic-yearly',
                'stripe_plan' => env('STRIPE_BASIC_YEARLY'),
                'price' => 165,
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro-monthly',
                'stripe_plan' => env('STRIPE_PRO_MONTHLY'),
                'price' => 40,
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro-yearly',
                'stripe_plan' => env('STRIPE_PRO_YEARLY'),
                'price' => 440,
            ],
        ];

        DB::table('plans')->insert($plans);
    }
}
