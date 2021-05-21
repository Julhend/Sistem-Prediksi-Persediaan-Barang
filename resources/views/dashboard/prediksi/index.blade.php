@extends('layouts.main')


@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <form action="{{ route('prediksi.prediksi') }}" method="get">
                <a type="" class="btn btn-success btn float-right" style="" href="{{ route('prediksi.create') }}"><i
                        class="fas fa-user-plus"></i>
                    Create Prediksi</a>
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
                                {{-- <table id="sale" class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Permintaan Tertinggi</th>
                                            <th>Permintaan Terendah</th>
                                            <th>Persediaan Tertinggi</th>
                                            <th>Persediaan Terendah</th>
                                            <th>Pembelian Tertinggi</th>
                                            <th>Pembelian Terendah</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $maxsale }}</td>
                                <td>{{ $minsale }}</td>
                                <td>{{ $maxstock }}</td>
                                <td>{{ $minstock }}</td>
                                <td>{{ $maxpurchase }}</td>
                                <td>{{ $minpurchase }}</td>

                                </td>
                                </tr>

                                </tbody>


                                </table> --}}
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

                            {{-- <div class="modal-footer form-group">
                                <button type="submit" class="btn btn-success float-right"
                                    href="{{ route('prediksi.store') }}"><i class="fas fa-caret-right"></i>
                            Proses</button> --}}
                            <div class="modal-footer form-group">
                                <button type="submit" class="btn btn-success float-left"><i
                                        class="fas fa-caret-right"></i>
                                    Proses</button>
                            </div>

                    </div>

                    {{-- <div class="col-md-12">
                        <div class="form-group">
                            <label>✧✧✧✧Permintaan✧✧✧✧</label>
                        </div>
                        <div class="form-group">
                            <label>Permintaan Banyak </label>
                            <input readonly type="number" name="permintaan_tertinggi" id="permintaan_tertinggi"
                                class="form-control" min="0" value="0">

                        </div>
                        <div class="form-group">
                            <label>Persediaan | Stocks </label>
                            <input readonly type="number" name="persediaan_tertinggi" id="" class="form-control" min="0"
                                value="0">
                        </div>
                        <div class="form-group">
                            <label>Pembelian | Purchases </label>
                            <input readonly type="number" name="pembelian_tertinggi" id="" class="form-control" min="0"
                                value="0">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>✧✧✧✧Nilai Terendah✧✧✧✧</label>
                        </div>
                        <div class="form-group">
                            <label>Permintaan | Sales</label>
                            <input readonly type="number" name="permintaan_terendah" id="permintaan_terendah"
                                class="form-control" min="0" value="0">
                        </div>
                        <div class="form-group">
                            <label>Persediaan | Stocks</label>
                            <input readonly type="number" name="persediaan_terendah" id="persediaan_terendah"
                                class="form-control" min="0" value="0">
                        </div>
                        <div class="form-group">
                            <label>Pembelian | Purhcases</label>
                            <input readonly type="number" name="pembelian_terendah" id="pembelian_terendah"
                                class="form-control" min="0" value="0">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>✧✧✧✧Hasil Rules✧✧✧✧</label>
                        </div>
                        <div class="form-group">
                            <label>Rules 1</label>
                            <input readonly type="number" name="rules_pertama" id="rules_pertama" class="form-control"
                                min="0" value="0">

                        </div>
                        <div class="form-group">
                            <label>Rules 2</label>
                            <input readonly type="number" name="rules_kedua" id="rules_kedua" class="form-control"
                                vmin="0" value="0">

                        </div>
                        <div class="form-group">
                            <label>Rules 3</label>
                            <input readonly type="number" name="rules_ketiga" id="rules_ketiga" class="form-control"
                                min="0" value="0">

                        </div>
                        <div class="form-group">
                            <label>Rules 4</label>
                            <input readonly type="number" name="rules_keempat" id="rules_keempat" class="form-control"
                                min="0" value="0">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>✧✧✧✧Defuzifikasi✧✧✧✧</label>
                            <input readonly type="number" name="defuzifikasi" id="defuzifikasi" class="form-control"
                                min="0" value="0">

                        </div>
                        <div class="form-group">
                            <label>✧✧✧✧Kesimpulan✧✧✧✧</label>
                            <input readonly type="text" name="kesimpulan" id="kesimpulan" class="form-control">
                           
                        </div>
                        <div class="modal-footer form-group">
                            <button type="submit" class="btn btn-success float-right"
                                href="{{ route('prediksi.store') }}"><i class="fas fa-print"></i>
                    Cetak</button>
                </div> --}}
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