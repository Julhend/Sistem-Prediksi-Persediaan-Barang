<?php

namespace App\Http\Controllers\Dashboard;


use App\Product;
use App\Predict;
use App\Purchase;
use App\ProductPurchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class PredictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $predict = Predict::with('products')->get();
        return view('dashboard.prediksi.index', compact('predict'));
    }

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
        $barang = $request->nama_barang;
        
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

        //mencari nilai tengah permintaan
        $pmttgh1 = $maxsale - $minsale;
        $pmttgh2 = $pmttgh1 / 2;
        $pmttengah = $pmttgh2 + $minsale;

        //mencari nilai tengah persediaan
        $psdtgh1 = $maxstock - $minstock;
        $psdtgh2 = $psdtgh1 / 2;
        $psdtengah = $psdtgh2 + $minstock;

        if ($inputpermintaan <= $pmttengah && $inputpersediaan >= $psdtengah ){
            $deff = $pmb1;
             $kesimpulan = "Jadi  jumlah  barang  yang  di  beli oleh pihak
             Toko Harapan Baru  menurut  Metode  Sugeno  adalah $deff buah, jika Permintaan $inputpermintaan dan Persediaan $inputpersediaan";
        } 
        elseif ($inputpermintaan <= $pmttengah && $inputpersediaan <=  $psdtengah) {
            $deff = $pmbberkurang;
             $kesimpulan = "Jadi  jumlah  barang  yang  di  beli oleh pihak
             Toko Harapan Baru  menurut  Metode  Sugeno  adalah $deff buah, jika Permintaan $inputpermintaan dan Persediaan $inputpersediaan";
        } elseif ($inputpermintaan >= $pmttengah && $inputpersediaan >= $psdtengah) {
             $deff = $pmb2;
             $kesimpulan = "Jadi  jumlah  barang  yang  di  beli oleh pihak
             Toko Harapan Baru  menurut  Metode  Sugeno  adalah $deff buah, jika Permintaan $inputpermintaan dan Persediaan $inputpersediaan";
        } elseif ($inputpermintaan >= $pmttengah && $inputpersediaan <= $psdtengah) {
             $deff = $pmbbertambah;
             $kesimpulan = "Jadi  jumlah  barang  yang  di  beli oleh pihak
             Toko Harapan Baru  menurut  Metode  Sugeno  adalah $deff buah, jika Permintaan $inputpermintaan dan Persediaan $inputpersediaan";
        };

        $predicts = Predict::create([
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
              'defuzifikasi' => $deff,
              'kesimpulan' => $kesimpulan,
               'product_name' => $barang,
          ]);
        $predicts->products()->attach($ids);
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Predict  $predict
     * @return \Illuminate\Http\Response
     */
   public function show(Predict $prediksi)
    {
        $product_predict = $prediksi->products;
        $predicts = Predict::findorfail($prediksi)->first();
        // dd($prediksi);
        return view('dashboard.prediksi.showtwo', compact('prediksi','product_predict'));
    }


     public function create(Request $request)
    {   
        
        $products = Product::all();
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

     public function destroy(Predict $prediksi)
    {
         $prediksi->delete();
         toast('Predict deleted Successfully', 'error', 'top-right');
        return redirect()->back();
    }
}