<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hashids\Hashids;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
use App\Models\BillingDetail;
use App\Models\Product;
use App\Models\Threshold;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids(env('USER_HASH_KEY', 1), 8);
            $record->hash = $hashids->encode($record->id);
            $record->save();
            $threshold = new Threshold([
                'user_id' => $record->id,
            ]);
            $threshold->save();
        });
    }

    public function billing_details()
    {
        return $this->hasOne(BillingDetail::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function threshold()
    {
        return $this->hasOne(Threshold::class, 'user_id', 'id');
    }

    public function has_pro_plan()
    {
        $subscription = $this->subscriptions()->select('name')->first();
        if (!$subscription) return false;
        return str_starts_with($subscription->name, 'pro');
    }

    public function is_over_api_limit()
    {
        $threshold = $this->threshold()->first();
        return $threshold->api_calls_count > $threshold->api_calls_limit;
    }

    public function is_over_product_limit($id)
    {
        $subscription = $this->subscriptions()->select('name')->first();
        $threshold = $this->threshold()->first();
        if (!$subscription && $threshold->basic_threshold_id) return $id > $threshold->basic_threshold_id;
        if ($subscription && str_starts_with($subscription->name, 'basic') && $threshold->pro_threshold_id) return $id > $threshold->pro_threshold_id;
        return false;
    }

    public function call_api()
    {
        $threshold = $this->threshold()->first();
        $threshold->api_calls_count++;
        $threshold->save();
    }
}
