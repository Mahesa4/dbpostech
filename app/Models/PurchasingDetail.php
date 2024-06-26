<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchasingDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_trans',
        'product_id',
        'product_name',
        'purchasing_price',
        'qty',
        'sub_total',
        'id_purchase',
    ];

    public function purchase(){
        return $this->belongsTo(Purchasing::class, 'id_purchase');
    }

    public static function boot(){
        parent::boot();

        static::creating(function ($details) {   
             $product = DB::table('products')->where('id', $details->product_id);
             $product->update(["qty" => round($product->first()->qty - $details->qty)]);
        });
    }
}
