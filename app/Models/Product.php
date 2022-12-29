<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids\Hashids;
use App\Models\ProductInfo;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FilterQueryString;

    protected $filters = ['sort', 'where_any'];

    protected $fillable = ['name', 'user_id', 'identification_code', 'status', 'hash'];
    protected $guarded = ['id', 'hash'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids('4cfb2dc7962f4e0a3894043e95f776fc', 8);
            $record->hash = $hashids->encode($record->id);
            $record->save();
        });
    }

    public function where_any($query, $value)
    {
        return $query->where('identification_code', 'ILIKE', '%' . $value . '%')->orWhere('name', 'ILIKE', '%' . $value . '%')->orWhere('hash', 'ILIKE', '%' . $value . '%');
    }

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function product_infos()
    {
        return $this->hasMany(ProductInfo::class, 'product_id', 'id');
    }

    public function info()
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        return $this->hasOne(ProductInfo::class, 'product_id', 'id')->whereHas('language', function ($q) use ($lang) {
            $q->where('code', $lang);
        });
    }

    public function request_info($hash)
    {
        return $this->hasOne(ProductInfo::class, 'product_id', 'id')->where('hash', $hash);
    }
}
