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


    public function prediksi()
    {

    $products = Product::all();
    $sale = Sale::all();
    $purchase = Purchase::all();






        // return view('dashboard.prediksi.index');
    }


    public function masuk(Request $request){
     $products = Product::all();
     $purchase =\DB::table('product_purchase')
            ->where('product_id',$request->product_id)
            ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
            ->get();


        $max_quantity = \DB::table('product_purchase')
        ->orderByRaw('quantity DESC LIMIT 1')
         ->where('product_id',1)
        ->whereBetween('created_at', ['2021-01-18' , '2021-05-8'])
        ->get();

        //  foreach ($max_quantity as $max) {
        //   dd($max->quantity);
        //     }

    
        // dd($max_quantity->quantity);

            // $price = \DB::table('orders')->max('price');
        return view('dashboard.prediksi.productMasuk', compact('products','purchase'));
    }


 public function productKeluar(Request $request){
     $products = Product::all();
     $sale =\DB::table('product_sale')
            ->where('product_id',$request->product_id)
            ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
            ->get(); 
    return view('dashboard.prediksi.productKeluar', compact('products','sale'));
    }

}