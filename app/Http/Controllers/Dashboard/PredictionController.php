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

  
    public function masuk(Request $request){

    // product_purchases = Purchase::with('products')->get()->toArray();
    //         foreach ($product_purchases as $product) {

    //   dd($product);
    //         }

     $products = Product::all();
     $purchase =\DB::table('product_purchase')
            ->where('product_id',$request->product_id)
            ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
            ->get();
        return view('dashboard.prediksi.productMasuk', compact('products','purchase'));

    }



 public function keluar(Request $request){

    // product_purchases = Purchase::with('products')->get()->toArray();
    //         foreach ($product_purchases as $product) {

    //   dd($product);
    //         }

     $products = Product::all();
     $sale =\DB::table('product_sale')
            ->where('product_id',$request->product_id)
            ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
            ->get();
        // return view('dashboard.prediksi.productMasuk'
    return view('dashboard.prediksi.productKeluar', compact('products','purchase'));
    }

}