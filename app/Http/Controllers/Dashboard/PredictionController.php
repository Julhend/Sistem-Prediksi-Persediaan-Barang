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
        $products = Product::all();

            //nilai terbesar
        // $maxstock = \DB::table('products')
        //     ->orderByRaw('stock DESC LIMIT 1')
        //     ->where('id',$request->product_id)
        //     ->get();


        // $maxpurchase =\DB::table('product_purchase')
        //     ->orderByRaw('quantity DESC LIMIT 1')
        //     ->where('product_id',$request->product_id)
        //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        //     ->get();

        //  $maxsale =\DB::table('product_sale')
        //     ->orderByRaw('quantity DESC LIMIT 1')
        //     ->where('product_id',$request->product_id)
        //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        //     ->get(); 
          


            //nila terkecil
        // $minstock = \DB::table('products')
        //     ->orderByRaw('stock ASC LIMIT 1')
        //     ->where('id',$request->product_id)
        //     ->get();

        // $minpurchase =\DB::table('product_purchase')
        //     ->orderByRaw('quantity ASC LIMIT 1')
        //     ->where('product_id',$request->product_id)
        //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        //     ->get();

        //  $minsale =\DB::table('product_sale')
        //     ->orderByRaw('quantity ASC LIMIT 1')
        //     ->where('product_id',$request->product_id)
        //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        //     ->get(); 


        // $maxsale =  \DB::table('product_sale')
        // ->where('product_id',2)
        // ->whereBetween('created_at', ['2021-05-04','2021-05-08'])
        // ->max('quantity');


        // dd($maxsale);
            //    $maxpmt = foreach ($maxsale as $maxsales) {
            //        $maxsales->quantity;
            //  
        //    }


        $maxsale =  \DB::table('product_sale')
        ->where('product_id',2)
        ->whereBetween('created_at', ['2021-04-04','2021-06-08'])
        ->max('quantity');

        $maxpurchase =  \DB::table('product_purchase')
        ->where('product_id',2)
         ->whereBetween('created_at', ['2021-04-04','2021-06-08'])
        ->max('quantity');
        $maxstock =  \DB::table('products')
        ->where('id',2)
        ->max('stock');


        $minsale =  \DB::table('product_sale')
        ->where('product_id',2)
          ->whereBetween('created_at', ['2021-04-04','2021-06-08'])
        ->min('quantity');
        $minpurchase =  \DB::table('product_purchase')
        ->where('product_id',2)
         ->whereBetween('created_at', ['2021-04-04','2021-06-08'])
        ->min('quantity');
        $minstock =  \DB::table('products')
        ->where('id',2)
        ->min('stock');
 

        //mencari nilai permintaan rendah
        $pmt1 = $maxsale - 1800;
        $pmt2 = $maxsale - $minsale;
        $pmtrendah = $pmt1 / $pmt2;
        
        //mencari nilai permintaan tinggi
        $pmt3 = 1800 - $minsale;
        $pmt4 = $maxsale - $minsale;
        $pmttinggi = $pmt3 / $pmt4;

        //mencari nilai persediaan sedikit
        $psd1 = $maxstock - 140;
        $psd2 = $maxstock - $minstock;
        $psdrendah = $psd1 / $psd2;
        //mencari nilai persediaan banyak
        $psd3 = 140 - $minstock;
        $psd4 = $maxstock - $minstock;
        $psdtinggi = $psd3 / $psd4;

        //mencari nilai pembelian berkurang
        $pmb1 = $maxpurchase - 750;
        $pmb2 =  $maxpurchase - $minpurchase;
        $pmbberkurang = $pmb1 / $pmb2;
        //mencari nilai pembelian bertambah
        $pmb3 = 750 - $minpurchase;
        $pmb4 = $maxpurchase - $minpurchase;
        $pmbbertambah = $pmb3 / $pmb4;
           






dd($pmbbertambah);




        return view('dashboard.prediksi.index', compact('products'));
    }


public function maxpurchase(Request $request)
    {
         
            $data = \DB::table('product_purchase')
            ->orderByRaw('quantity DESC LIMIT 1')
            ->where('product_id',$request->product_id)
            ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
            ->get()
            ->toJson();    

        //  return Response::json(array(
        //     'product_purchase' => $purchases,
        // ));

 return view('dashboard.prediksi.index', compact('data'));

    }





    public function masuk(Request $request){
     $products = Product::all();
     $purchase =\DB::table('product_purchase')
            ->orderByRaw('quantity DESC LIMIT 1')
            ->where('product_id',$request->product_id)
            ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
            ->get();
        return view('dashboard.prediksi.productMasuk', compact('products','purchase'));
    }


 public function productKeluar(Request $request){
     $products = Product::all();
     $sale =\DB::table('product_sale')
            ->orderByRaw('quantity DESC LIMIT 1')
            ->where('product_id',$request->product_id)
            ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
            ->get(); 
    return view('dashboard.prediksi.productKeluar', compact('products','sale'));
    }

}