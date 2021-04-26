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
                            href="{{ route('prediksi.productMasuk') }}"><i class="fas fa-file-alt"></i>
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
                        <form action="{{ route('client.store') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Wajib Di Input</label>
                                    <div class="form-group">
                                        <input type="text" name="input_permintaan" id="" class="form-control"
                                            placeholder="permintaan" value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="input_persediaan" id="" class="form-control"
                                            placeholder="persediaan" value="{{ old('phone') }}">
                                    </div>
                                </div>

                                <div class="modal-footer form-group">
                                    <button type="submit" class="btn btn-success float-right"
                                        href="{{ route('client.store') }}"><i class="fas fa-caret-right"></i>
                                        Proses</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nilai Tertinggi</label>
                                        <input disabled type="text" name="nilai_tertinggi" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Permintaan</label>
                                        <input disabled type="text" name="permintaan_tertinggi" id=""
                                            class="form-control" value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Persediaan</label>
                                        <input disabled type="text" name="persediaan_tertinggi" id=""
                                            class="form-control" value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Target Penjualan</label>
                                        <input disabled type="text" name="target_tertinggi" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nilai Terendah</label>
                                        <input disabled type="text" name="nilai_terendah" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Permintaan</label>
                                        <input disabled type="text" name="permintaan_terendah" id=""
                                            class="form-control" value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Persediaan</label>
                                        <input disabled type="text" name="persediaan_terendah" id=""
                                            class="form-control" value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Target Penjualan</label>
                                        <input disabled type="text" name="target_terendah" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Permintaan</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Sedikit</label>
                                        <input disabled type="text" name="sedikit" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Banyak</label>
                                        <input disabled type="text" name="banyak" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Penjualan</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Turun</label>
                                        <input disabled type="text" name="turun" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Naik</label>
                                        <input disabled type="text" name="naik" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hasil Rules</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 1</label>
                                        <input disabled type="text" name="rules_pertama" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 2</label>
                                        <input disabled type="text" name="rules_kedua" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 3</label>
                                        <input disabled type="text" name="rules_ketiga" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 4</label>
                                        <input disabled type="text" name="rules_keempat" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Defuzifikasi</label>
                                        <input disabled type="text" name="defuzifikasi" id="" class="form-control"
                                            value="{{ old('client_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kesimpulan</label>
                                        <input disabled type="text" name="kesimpulan" id="" class="form-control"
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