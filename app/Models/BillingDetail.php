<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'line1', 'line2', 'city', 'state', 'postal_code', 'country'];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
