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
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <select name="product_id" id="id" class="form-control">
                                <option value="">@lang('site.product')</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ request()->product_id == $product->id ? 'selected' : ''}}>{{
                                                                            $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <input type="date" name="tgl_awal" class="form-control" value="{{ request()->tgl_awal }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="date" name="tgl_akhir" class="form-control" value="{{ request()->tgl_akhir }}">
                        </div>

                        <div class="col-md-3 form-group">
                            <button type="submit" class="btn btn-success float-left" onclick="autofill()"><i
                                    class="fas fa-search"></i>
                                @lang('site.search') </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div id="prediksi_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{ route('prediksi.store') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-6">
                                </div>
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
                                        href="{{ route('prediksi.store') }}"><i class="fas fa-caret-right"></i>
                                        Proses</button>
                                </div>
                                {{-- get  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Nilai Tertinggi✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Permintaan | Sales </label>
                                        <input readonly type="number" name="permintaan_tertinggi"
                                            id="permintaan_tertinggi" class="form-control" min="0" value="0">

                                    </div>
                                    <div class="form-group">
                                        <label>Persediaan | Stocks </label>
                                        <input readonly type="number" name="persediaan_tertinggi" id=""
                                            class="form-control" min="0" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Pembelian | Purchases </label>
                                        <input readonly type="number" name="pembelian_tertinggi" id=""
                                            class="form-control" min="0" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Nilai Terendah✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Permintaan | Sales</label>
                                        <input readonly type="number" name="permintaan_terendah"
                                            id="permintaan_terendah" class="form-control" min="0" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Persediaan | Stocks</label>
                                        <input readonly type="number" name="persediaan_terendah"
                                            id="persediaan_terendah" class="form-control" min="0" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Pembelian | Purhcases</label>
                                        <input readonly type="number" name="pembelian_terendah" id="pembelian_terendah"
                                            class="form-control" min="0" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Hasil Rules✧✧✧✧</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Rules 1</label>
                                        <input readonly type="number" name="rules_pertama" id="rules_pertama"
                                            class="form-control" min="0" value="0">

                                    </div>
                                    <div class="form-group">
                                        <label>Rules 2</label>
                                        <input readonly type="number" name="rules_kedua" id="rules_kedua"
                                            class="form-control" vmin="0" value="0">

                                    </div>
                                    <div class="form-group">
                                        <label>Rules 3</label>
                                        <input readonly type="number" name="rules_ketiga" id="rules_ketiga"
                                            class="form-control" min="0" value="0">

                                    </div>
                                    <div class="form-group">
                                        <label>Rules 4</label>
                                        <input readonly type="number" name="rules_keempat" id="rules_keempat"
                                            class="form-control" min="0" value="0">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>✧✧✧✧Defuzifikasi✧✧✧✧</label>
                                        <input readonly type="number" name="defuzifikasi" id="defuzifikasi"
                                            class="form-control" min="0" value="0">

                                    </div>
                                    <div class="form-group">
                                        <label>✧✧✧✧Kesimpulan✧✧✧✧</label>
                                        <input readonly type="text" name="kesimpulan" id="kesimpulan"
                                            class="form-control">
                                        {{-- <textarea id="kesimpulan" name="kesimpulan"></textarea> --}}
                                    </div>
                                    <div class="modal-footer form-group">
                                        <button type="submit" class="btn btn-success float-right"
                                            href="{{ route('prediksi.store') }}"><i class="fas fa-print"></i>
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
    function autofill(){
       var id = $("#id").val();
      $.ajax({
        // type: "GET",
        url: "/max-purchase",
        data: 'id=' + id,
        }).success(function(data){
            var json = data,
            obj = JSON.parse(json); 
                $("#max_purchase").val(obj.quantity);
        });
   }

</script>
@endsection