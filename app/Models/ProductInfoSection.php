<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids\Hashids;
use App\Models\User;

class ProductInfoSection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'product_info_id', 'title', 'content'];
    protected $guarded = ['id', 'hash'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids(env('PRODUCT_INFO_SECTION_HASH_KEY', 1), 8);
            $record->hash = $hashids->encode($record->id);
            $record->save();
        });
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
