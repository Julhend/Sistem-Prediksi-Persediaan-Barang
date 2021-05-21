@extends('layouts.main')


@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <form action="{{ route('prediksi.prediksi') }}" method="get">

                <div class="row">
                    <div class="col-md-4 form-group">
                        <select name="product_id" id="id" class="form-control">
                            <option value="">@lang('site.product')</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ request()->product_id == $product->id ? 'selected' : ''}}>{{
                                                    $product->product_name }}</option>
                            {{-- 
                                            {{ old('product_id') == $product->id ? 'selected' : ''}}>{{
                                            $product->product_name }}</option> --}}
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <input type="date" name="tgl_awal" class="form-control" value="{{ request()->tgl_awal }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ request()->tgl_akhir }}">
                    </div>

                </div>
                <div class="col-md-3 form-group float-right">
                    <button type=" submit" class="btn btn-success float-left"><i class="fas fa-search"></i>
                        @lang('site.search') </button>
                </div>
            </form>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div id="prediksi_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{ route('prediksi.index') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Input Permintaan</label>
                                        <input type="number" name="input_permintaan" id="" class="form-control"
                                            value="{{ old('input_permintaan') }}">

                                    </div>
                                    <div class="form-group">
                                        <label>Input Persediaan</label>
                                        <input type="number" name="input_persediaan" id="" class="form-control"
                                            value="{{ old('input_persediaan') }}">

                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Permintaan Tertinggi</label>
                                        <input readonly type="number" name="max_sale" id=""
                                            class="form-control col-sm-12" placeholder="Permintaan Tertinggi"
                                            value="{{ $maxsale }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Permintaan Terendah</label>
                                        <input readonly type="number" name="min_sale" id=""
                                            class="form-control col-sm-12" placeholder="Permintaan Terendah"
                                            value="{{ $minsale }}">

                                    </div>
                                    <div class="form-group">
                                        <label>Persediaan Tertinggi</label>
                                        <input readonly type="number" name="max_stock" id=""
                                            class="form-control col-sm-12" placeholder="Persediaan Tertinggi"
                                            value="{{ $maxstock }}">
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Persediaan Terendah</label>
                                        <input readonly type="number" name="min_stock" id=""
                                            class="form-control col-sm-12" placeholder="Persediaan Terendah"
                                            value="{{ $minstock }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Pembelian Tertinggi</label>
                                        <input readonly type="number" name="max_purchase" id=""
                                            class="form-control col-sm-12" placeholder="Pembelian Tertinggi"
                                            value="{{ $maxpurchase }}">

                                    </div>
                                    <div class="form-group">
                                        <label>Pembelian Terendah</label>
                                        <input readonly type="number" name="min_purchase" id=""
                                            class="form-control col-sm-12" placeholder="Pembelian Terendah"
                                            value="{{ $minpurchase }}">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer form-group">
                                <button type="submit" class="btn btn-success float-left"
                                    href="{{ route('prediksi.index') }}"><i class="fas fa-caret-right"></i>
                                    Proses</button>
                            </div>

                    </div>
                </div>
            </div>
            @stop