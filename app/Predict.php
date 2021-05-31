<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;


class Prediction extends Model
{
    protected $guarded = [];

    // public function products()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_predict', 'product_id', 'predict_id')
        ->withTimestamps();
    }

}
