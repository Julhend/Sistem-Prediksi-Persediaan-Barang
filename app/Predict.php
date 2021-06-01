<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;


class Predict extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_predict', 'predict_id', 'product_id')
        ->withTimestamps();
    }

}