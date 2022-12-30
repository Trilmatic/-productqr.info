<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids\Hashids;
use App\Models\ProductInfo;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Database\Factories\ProductFactory;
use Illuminate\Support\Facades\Storage;

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
            //base settings
            $size = '200x200';
            $url = "/products/" . $record->hash . '/info';
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
            $data =  $protocol . $_SERVER['HTTP_HOST'] . $url;
            //Get QR code
            $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . '&chl=' . urlencode($data));
            //Add logo into QR
            $logo = imagecreatefromstring(file_get_contents(public_path("qr-logo.png")));

            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);

            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);

            // Scale logo to fit in the QR Code
            $logo_qr_width = $QR_width / 3;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;

            imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
            ob_start();
            imagepng($QR);
            $stringdata = ob_get_contents();
            ob_end_clean();
            //Sotre as file
            $file = Storage::put('qrcodes/' . $record->hash . '_' . 'qr.png', $stringdata);
            $path = '/qrcodes/' . $record->hash . '_' . 'qr.png';
            $record->qr_code = $path;
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
