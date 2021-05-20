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
 

        //mencari nilai permintaan rendah
        $pmt1 = $maxsale - $permintaan_tertinggi;
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
           






// dd($pmbbertambah);




        return view('dashboard.prediksi.index', compact('products','maxstock','maxsale','maxpurchase','minstock','minsale','minpurchase'));
    }


    public function getMaxStock($id){
        // if (empty($id)){
        //     return[];
        // }
          $maxstock = \DB::table('products')
            ->orderByRaw('stock DESC LIMIT 1')
            ->where('id',1)
            ->get();

            return $maxstock;

    }

/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number_sale' => 'required',
            'total' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
            'paid' => 'required',
            'credit' => 'required',
            'status' => 'required',
            'client_id' => 'required',
            'product' => 'required',
            'quantity' => 'required',
        ]);
        $data = $request->all();

        $sale = Sale::create([
            'number_sale' => $data['number_sale'],
            'total' => $data['total'],
            'discount' => $data['discount'],
            'total_amount' => $data['total_amount'],
            'paid' => $data['paid'],
            'due' => $data['credit'],
            'status' => $data['status'],
            'client_id' => $data['client_id'],

        ]);
        $dat = $data['product'];
        $qty = $request->get('quantity');
        //attach sale with there products and quantities
        $attach_data = [];
        for ($i = 0; $i < count($dat); $i++) {
            $attach_data[$dat[$i]] = ['quantity' => $qty[$i]];
        }
        $sale->products()->attach($attach_data);
        //check products stock and substract quntities that is sale
        for ($i = 0; $i < count($dat); $i++) {
            $product = Product::find($dat[$i]);
            if ($product->stock == 0) {
                toast('this product stock is empty', 'error', 'top-right');
            } else {
                $product->stock = $product->stock - ($qty[$i]);
                $product->save();
            }
        }
        return redirect()->back();
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