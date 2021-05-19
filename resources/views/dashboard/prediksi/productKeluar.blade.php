@extends('layouts.main')


@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">

            <form action="{{ route('prediksi.productKeluar') }}" method="get">

                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        {{-- <h3 class="card-title">@lang('site.tabdata')</h3> --}}
                        <h3 class="card-title">Nilai Product Keluar Terbesar</h3>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <select name="product_id" class="form-control">
                            <option value="">@lang('site.product')</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ request()->product_id == $product->id ? 'selected' : ''}}>{{
                                                        $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <input type="date" name="tgl_awal" class="form-control" value="{{ request()->tgl_awal }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ request()->tgl_akhir }}">
                    </div>

                    <div class="col-md-2 form-group">
                        <button type="submit" class="btn btn-success float-left"><i class="fas fa-search"></i>
                            @lang('site.search') </button>
                    </div>
                </div>

        </div>
        </form>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        <div id="product_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm-6 col-md-8">
                        </div>

                    </div>
                    <table id="product_table" class="table table-bordered table-striped table-hover  dataTable"
                        role="grid" aria-describedby="product_table_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="product_table" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 283px;">No</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                    @lang('site.datepurchase')</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                    @lang('site.qty')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->quantity }}</td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal-footer form-group">
                        <button type="submit" class="btn btn-success float-right" href="{{ route('client.store') }}"><i
                                class="fas fa-caret-right"></i>
                            Proses</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.card-body -->

</div>
</div>


@stop