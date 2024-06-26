<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_trans',
        'vendor_id',
        'admin_id',
        'date_purchase',
        'product_status',
        'grand_total',
    ];

    public function details(){
        return $this->hasMany(PurchasingDetail::class, 'id_purchase', 'id');
    }

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id');
    }
}
