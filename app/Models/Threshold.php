<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threshold extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'basic_threshold_id', 'pro_threshold_id', 'basic_threshold_limit', 'pro_threshold_limit', 'api_calls_count', 'api_calls_limit'];
}
