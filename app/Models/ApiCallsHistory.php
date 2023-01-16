<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiCallsHistory extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'api_calls_count', 'api_calls_limit'];
}
