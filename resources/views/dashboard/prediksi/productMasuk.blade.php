@extends('layouts.main')


@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">

            <form action="{{ route('prediksi.productMasuk') }}" method="get">

                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        {{-- <h3 class="card-title">@lang('site.tabdata')</h3> --}}
                        <h3 class="card-title">Data Product Masuk</h3>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                            value="{{ request()->search }}">
                    </div>

                    <div class="col-md-2 form-group">
                        <input type="date" name="tgl_awal" class="form-control" value="{{ old('tgl_awal') }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ old('tgl_akhir') }}">
                    </div>
                    {{-- <div class="col-md-4 form-group">
                        <select name="category_id" class="form-control">
                            <option value="">@lang('site.categories')</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                    {{ request()->category_id == $category->id ? 'selected' : ''}}>{{
                                    $category->category_name }} {{
                                    $category->brand_name }}</option>
                    @endforeach
                    </select>
                </div> --}}
                <div class="col-md-4 form-group">
                    <button type="submit" class="btn btn-success float-left"><i class="fas fa-search"></i>
                        @lang('site.search') </button>
                </div>

                {{-- <div class="col-md-4 form-group">
                    <a href="{{ route('prediksi.productMasuk', $purchase->id) }}" class="btn btn-primary btn-sm"><i
                    class="fas fa-print"></i></a>
        </div> --}}

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
                <table id="product_table" class="table table-bordered table-striped table-hover  dataTable" role="grid"
                    aria-describedby="product_table_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                                style="width: 283px;">No</th>
                            <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                @lang('site.productname')</th>
                            <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                @lang('site.datepurchase')</th>
                            <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                @lang('site.purchaseprice')</th>
                            <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                @lang('site.qty')</th>
                            <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">
                                @lang('site.totalprice')</th>

                        </tr>
                    </thead>
                    <tbody>

                        {{-- @foreach ($product_purchases as $index => $product_purchase ) --}}
                        {{-- @foreach ($provider->purchases as $index => $purchase) --}}
                        @foreach ($product_purchases as $index => $product_purchase)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product_purchase->product_name}}</td>
                            <td>{{ $product_purchase->created_at }}</td>
                            <td>{{ number_format($product_purchase->purchase_price) }}</td>
                            <td>{{ $product_purchase->quantity }}</td>
                            <td>{{ number_format($product_purchase ->quantity * $product_purchase ->purchase_price) }}

                            </td>



                            {{-- <td>{{ $product_purchase -> total }}</td> --}}
                        </tr>
                        {{-- @endforeach --}}
                        @endforeach

                        {{-- @foreach ($product_purchases as $index => $product_purchase )
                        <tr>
                            <td>{{ $index + 1 }}</td>
                        <td>{{ $product_purchase->products->product_name }}</td>
                        <td>{{ $product_purchase->total }}</td>

                        <td style="text-align:center;">
                            Rp.{{ number_format($product_purchase->paid, 2) }}
                        </td>
                        <td style="text-align:center;">{{ $product_purchase->pivot->quantity }}</td>
                        <td style="text-align:center;">
                            Rp.{{ number_format($product_purchase->pivot->quantity * $product_purchase->purchase_price, 2) }}
                        </td>
                        </tr>
                        @endforeach --}}
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