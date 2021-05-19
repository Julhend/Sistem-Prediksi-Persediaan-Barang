<?php

namespace App;

use App\Sale;
use App\Category;
use App\Purchase;
use App\ProductPurchase;
use App\Prediction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $appends = ['image_path', 'profit'];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sale', 'product_id', 'sale_id')
        ->withPivot('quantity')
        ->withTimestamps();
    }
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'product_purchase', 'product_id', 'purchase_id')
        ->withPivot('quantity')
        ->withTimestamps();
    }

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    }
    public function getProfitAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        return $profit;
    }
     public function predict()
    {
        return $this->hasMany(Prediction::class);
    }
}