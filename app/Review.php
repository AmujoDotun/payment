<?php

namespace App;
use App\Product;s

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}
