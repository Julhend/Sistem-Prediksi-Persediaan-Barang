<?php

namespace App\Http\Controllers\Dashboard;


use App\Product;
use App\Prediction;
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
        $maxsale =0;
        $maxpurchase=0;
        $minsale=0;
        $minpurchase=0;
        $maxstock=0;
        $minstock=0;

        return view('dashboard.prediksi.index', compact(
            'products',
            'maxsale',
            'maxpurchase',
            'minstock',
            'minsale',
            'minpurchase',
            'maxstock',
        ));
    }

    public function prediksi(Request $request){ 
    
        $products = Product::all();

        $maxsale =  \DB::table('product_sale')
        ->where('product_id',$request->product_id)
        ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        ->max('quantity');
        $maxpurchase =  \DB::table('product_purchase')
        ->where('product_id',$request->product_id)
        ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        ->max('quantity');
        $maxstock =  \DB::table('products')
        ->where('id',$request->product_id)
        ->max('stock');

        $minsale =  \DB::table('product_sale')
       ->where('product_id',$request->product_id)
        ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        ->min('quantity');
        $minpurchase =  \DB::table('product_purchase')
        ->where('product_id',$request->product_id)
        ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
        ->min('quantity');
        $minstock =  \DB::table('products')
        ->where('id',$request->product_id)
        ->min('min_stock');

        return view('dashboard.prediksi.index', compact(
            'products',
            'maxstock',
            'maxsale',
            'maxpurchase',
            'minstock',
            'minsale',
            'minpurchase'
        ));
    }

 public function store(Request $request){

        $maxsale =  $request->max_sale;
        // $maxpurchase =  
        // $minsale =  
        // $minpurchase =  
        // $minstock =  
        $inputpermintaan = $request->input_permintaan;
        $inputpersediaan = $request->input_persediaan;
        $inputpembelian = $request->input_pembelian;

//          // mencari nilai permintaan rendah
//             $pmt1 = $maxsale - $inputpermintaan;
//             $pmt2 = $maxsale - $minsale;
//             $pmtrendah = $pmt1 / $pmt2;

// //             $pmt1 = 3000 - $inputpermintaan;
// //             $pmt2 = 3000 - 2000;
// //             $pmtrendah = $pmt1 / $pmt2;
            
//             // mencari nilai permintaan tinggi
//             $pmt3 = $inputpermintaan - $minsale;
//             $pmt4 = $maxsale - $minsale;
//             $pmttinggi = $pmt3 / $pmt4;

//             //mencari nilai persediaan sedikit
//             $psd1 = $maxstock - $inputpersediaan;
//             $psd2 = $maxstock - $minstock;
//             $psdrendah = $psd1 / $psd2;

//             //mencari nilai persediaan banyak
//             $psd3 = $inputpersediaan - $minstock;
//             $psd4 = $maxstock - $minstock;
//             $psdtinggi = $psd3 / $psd4;

//             //mencari nilai pembelian berkurang
//             $pmb1 = $maxpurchase - $input_pembelian;
//             $pmb2 =  $maxpurchase - $minpurchase;
//             $pmbberkurang = $pmb1 / $pmb2;

//             //mencari nilai pembelian bertambah
//             $pmb3 = $input_pembelian - $minpurchase;
//             $pmb4 = $maxpurchase - $minpurchase;
//             $pmbbertambah = $pmb3 / $pmb4;


          Prediction::create([
              'product_id' => $request['product_id'],
              'input_permintaan' => $request['input_permintaan'],
              'input_persediaan' => $request['input_persediaan'],
              'input_pembelian' => $request['input_pembelian'],
            //   'permintaan_terendah' => $pmtrendah,
            //   'permintaan_tertinggi' => $pmttinggi,
            //   'persediaan_terendah' => $psdrendah,
            //   'persediaan_terendah' => $psdtinggi,
            //   'pembelian_terendah' => $pmbberkurang,
            //   'pembelian_terendah' => $pmbbertambah,
          ]);

            return redirect()->back();
    }

}