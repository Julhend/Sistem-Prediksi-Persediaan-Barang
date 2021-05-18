@extends('layouts.main')


@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">

            <form action="{{ route('prediksi.index') }}" method="get">

                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        <h3 class="card-title">@lang('site.prediksi')</h3>
                    </div>
                    <div class="col-6 col-md-4">
                        <a type="" class="btn btn-success btn float-left" style=""
                            href="{{ route('prediksi.masuk') }}"><i class="fas fa-file-alt"></i>
                            @lang('site.datamasuk')</a>

                        <a type="" class="btn btn-success btn float-right" style=""
                            href="{{ route('prediksi.productKeluar') }}"><i class="fas fa-clipboard-list"></i>
                            @lang('site.datakeluar')</a>

                    </div>
                </div>
            </form>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div id="prediksi_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        {{-- gantiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii --}}
                        <form action="{{ route('client.store') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Wajib Di Input</label>
                                    <div class="form-group">
                                        <input type="number" name="input_permintaan" id="" class="form-control col-sm-6"
                                            placeholder="permintaan" value="{{ old('input_permintaan') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="input_persediaan" id="" class="form-control col-sm-6"
                                            placeholder="persediaan" value="{{ old('input_persediaan') }}">
                                    </div>
                                </div>

                                <div class="modal-footer form-group">
                                    <button type="submit" class="btn btn-success float-right"
                                        href="{{ route('client.store') }}"><i class="fas fa-caret-right"></i>
                                        Proses</button>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Nilai Tertinggi✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Permintaan | Sales </label>
                                        <input readonly type="number" name="" id="" class="form-control"
                                            value="{{ old('permintaan') }}">

                                        {{-- <input disabled type="text" name="" id="" class="form-control" value="{{ old('permintaan') }}">
                                        --}}
                                        {{-- <input type="number" name="permintaan_tertinggi"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Persediaan | Stocks </label>
                                        <input readonly type="number" name="persediaan_tertinggi" id=""
                                            class="form-control" value="{{ old('persediaan') }}">
                                        {{-- <input type="number" name="persediaan_tertinggi"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Pembelian | Purchases </label>
                                        <input readonly type="number" name="pembelian_tertinggi" id=""
                                            class="form-control" value="{{ old('pembelian') }}">
                                        {{-- <input type="number" name="pembelian_tertinggi"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Nilai Terendah✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Permintaan | Sales</label>
                                        <input readonly type="number" name="permintaan_terendah" id=""
                                            class="form-control" value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="permintaan_terendah"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Persediaan | Stocks</label>
                                        <input readonly type="number" name="persediaan_terendah" id=""
                                            class="form-control" value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="persediaan_terendah"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Pembelian | Purhcases</label>
                                        <input readonly type="number" name="pembelian_terendah" id=""
                                            class="form-control" value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="pembelian_terendah"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Permintaan✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Sedikit</label>
                                        <input readonly type="number" name="sedikit" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="permintaan_sedikit"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Banyak</label>
                                        <input readonly type="number" name="banyak" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="permintaan_banyak"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Penjualan✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Turun</label>
                                        <input readonly type="number" name="turun" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="penjualan_turun"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Naik</label>
                                        <input readonly type="number" name="naik" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="penjualan_banyak"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Hasil Rules✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 1</label>
                                        <input readonly type="number" name="rules_pertama" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="rules_pertama"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 2</label>
                                        <input readonly type="number" name="rules_kedua" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="rules_kedua"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 3</label>
                                        <input readonly type="number" name="rules_ketiga" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="rules_ketiga"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 4</label>
                                        <input readonly type="number" name="rules_keempat" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="rules_keempat"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Defuzifikasi✧✧✧✧</label>
                                        <input readonly type="number" name="defuzifikasi" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <input type="number" name="defuzifikasi"
                                            class="form-control  col-sm-6 total-price" min="0" readonly value="0"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>✧✧✧✧Kesimpulan✧✧✧✧</label>
                                        <input readonly type="text" name="kesimpulan" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                        {{-- <textarea id="kesimpulan" name="kesimpulan"></textarea> --}}
                                    </div>
                                    <div class="modal-footer form-group">
                                        <button type="submit" class="btn btn-success float-right"
                                            href="{{ route('client.store') }}"><i class="fas fa-print"></i>
                                            Cetak</button>
                                    </div>
                                </div>


                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->


</div>
</div>


@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
        
    });

</script>
@endsection