<?php

namespace App\Http\Controllers\Dashboard;


use App\Product;
use App\Category;
use App\Provider;
use App\Purchase;
use App\ProductPurchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;



class PredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('dashboard.prediksi.index');
    }

    public function productKeluar(){
        return view('dashboard.prediksi.productKeluar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchas  e
     * @return \Illuminate\Http\Response
     */
    public function productMasuk(Request $request){
    
        $product_purchases = Product::with('purchases')->get();
        // $product_purchases = $purchase->products;
        $provider_purchases = $request->provider;

// TagCategory::whereIn('id', $chosenCategoriesIds)->with(['tags'])->get();

// dd($product_purchases->product_name);

        


        //  $product_purchases =\DB::table('product_purchase')
        //  ->leftJoin('products', 'product_purchase.purchase_id', '=', 'products.id') 
        //  ->join('purchases','product_purchase.purchase_id','=','purchases.id')
        //  ->get();

        // $product_purchases = ProductPurchase::whereBetwen('created_at',[$tglawal, $tglakhir])->get();
    
        // $purchases = Purchase::when($purchase->search, function ($q) use ($purchase) {
        //     return $q->where('product_name', 'like', '%' . $purchase->search . '%');
        // })->latest()->paginate(10);
        // return view('dashboard.prediksi.productMasuk', compact('product_purchases','provider_purchases','request','tglawal','tglakhir'));
    
        return view('dashboard.prediksi.productMasuk', compact('product_purchases','provider_purchases','request'));
    
    }

    public function productMasukPerTanggal($tglawal, $tglakhir){
        
    }
}