<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids\Hashids;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'user_id', 'status','hash'];
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids('4cfb2dc7962f4e0a3894043e95f776fc', 6);
            $record->hash = $hashids->encode($record->id);
            $record->save();
        });
    }
}
