<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids\Hashids;

class ProductInfo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'user_id', 'status', 'language_id', 'product_id', 'content'];
    protected $guarded = ['id','hash']; 

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids('7a761b3c42a239e08b68021fd8515685', 8);
            $record->hash = $hashids->encode($record->id);
            $record->save();
        });
    }
}
