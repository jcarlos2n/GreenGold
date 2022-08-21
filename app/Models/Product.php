<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
    ];

    public function origins(){
        return $this->belongsTo(Origin::class);
    }
    
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
