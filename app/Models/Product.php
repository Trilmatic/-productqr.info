<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids\Hashids;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FilterQueryString;

    protected $filters = ['sort', 'where_any'];

    protected $fillable = ['name', 'user_id', 'identification_code', 'status', 'hash'];
    protected $guarded = ['id'];

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
}
