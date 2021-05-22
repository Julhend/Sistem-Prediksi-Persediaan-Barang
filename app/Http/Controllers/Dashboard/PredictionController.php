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
        $predict = \DB::table('predictions')
        ->leftJoin('products', 'predictions.product_id','=','products.id')
        ->get();
      

        return view('dashboard.prediksi.index', compact('predict'));
    }

    // public function prediksi(Request $request){ 
    
    //     $products = Product::all();
    //     // $productss = \DB::table('products')
    //     // ->where('id',$request->product_id)
    //     // ->get();
    //     $maxsale =  \DB::table('product_sale')
    //     ->where('product_id',$request->product_id)
    //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
    //     ->max('quantity');
    //     $maxpurchase =  \DB::table('product_purchase')
    //     ->where('product_id',$request->product_id)
    //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
    //     ->max('quantity');
    //     $maxstock =  \DB::table('products')
    //     ->where('id',$request->product_id)
    //     ->max('stock');

    //     $minsale =  \DB::table('product_sale')
    //    ->where('product_id',$request->product_id)
    //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
    //     ->min('quantity');
    //     $minpurchase =  \DB::table('product_purchase')
    //     ->where('product_id',$request->product_id)
    //     ->whereBetween('created_at', [$request->tgl_awal,$request->tgl_akhir])
    //     ->min('quantity');
    //     $minstock =  \DB::table('products')
    //     ->where('id',$request->product_id)
    //     ->min('min_stock');

    //     return view('dashboard.prediksi.create', compact(
    //         'products',
    //         'maxstock',
    //         'maxsale',
    //         'maxpurchase',
    //         'minstock',
    //         'minsale',
    //         'minpurchase',
    //         // 'productss',
    //     ));
    // }

 public function store(Request $request){

        $maxsale =  $request->max_sale;
        $minsale = $request->min_sale;
        $maxpurchase = $request->max_purchase;
        $minpurchase = $request->min_purchase;
        $maxstock = $request->max_stock;
        $minstock = $request->min_stock;
        $inputpermintaan = $request->input_permintaan;
        $inputpersediaan = $request->input_persediaan;
        $ids = $request->id_barang;
        
        // mencari nilai permintaan rendah
        $pmt1 = $maxsale - $inputpermintaan;
        $pmt2 = $maxsale - $minsale;
        $pmtrendah = $pmt1 / $pmt2;

        // mencari nilai permintaan tinggi
        $pmt3 = $inputpermintaan - $minsale;
        $pmt4 = $maxsale - $minsale;
        $pmttinggi = $pmt3 / $pmt4;

        //mencari nilai persediaan sedikit
        $psd1 = $maxstock - $inputpersediaan;
        $psd2 = $maxstock - $minstock;
        $psdrendah = $psd1 / $psd2;

        //mencari nilai persediaan banyak
        $psd3 = $inputpersediaan - $minstock;
        $psd4 = $maxstock - $minstock;
        $psdtinggi = $psd3 / $psd4;


        //input pembelian tidak perluuuuuuuuuuuuuuuuuuuuuuuuuuu
        //output = pmt tinggi pmt rendah
        //output = persediaan banyak, persediaan sedikit
        
        //rules1
        $a1 = min($pmtrendah, $psdtinggi);
        $pmb1 = $inputpermintaan + $inputpersediaan;
        //rules2
        $a2 = min($pmtrendah, $psdrendah);
        $pmb1 = $maxpurchase - $minpurchase;
        $pmb2 = $a2 * $pmb1;
        $pmbberkurang = $maxpurchase - $pmb2;
        //rules3
        $a3 = min($pmttinggi, $psdtinggi);
        $pmb2 = $inputpermintaan - $inputpersediaan;
        //rules4
        $a4 = min($pmttinggi, $psdrendah);
        $pmb3 = $maxpurchase - $minpurchase;
        $pmb4 = $a4 * $pmb3;
        $pmbbertambah = $pmb4 + $minpurchase;


        $id = $request->product_name;
          Prediction::create([
              'product_id' => $ids,
              'input_permintaan' => $request['input_permintaan'],
              'input_persediaan' => $request['input_persediaan'],
              'permintaan_rendah' => $pmtrendah,
              'permintaan_tinggi' => $pmttinggi,
              'persediaan_sedikit' => $psdrendah,
              'persediaan_banyak' => $psdtinggi,
              'pembelian_berkurang' => $pmbberkurang,
              'pembelian_bertambah' => $pmbbertambah,
              'rules_satu' => $a1,
              'rules_dua' => $a2,
              'rules_tiga' => $a3,
              'rules_empat' => $a4,


          ]);

            return redirect()->back();
    }

public function show (Request $request){
    $prediksi = Prediction::all();
    
}

 public function create(Request $request)
    {  $products = Product::all();
        $productss = \DB::table('products')
        ->where('id',$request->product_id)
        ->get();
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

        return view('dashboard.prediksi.create', compact(
            'products',
            'maxstock',
            'maxsale',
            'maxpurchase',
            'minstock',
            'minsale',
            'minpurchase',
            'productss',
        ));


}
}