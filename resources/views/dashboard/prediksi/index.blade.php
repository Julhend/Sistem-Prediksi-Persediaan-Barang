@extends('layouts.main')


@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <a type="" class="btn btn-success btn float-right" style="" href="{{ route('prediksi.create') }}"><i
                    class="fas fa-chart-line"></i>
                Create Prediksi</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="product_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="product_table" class="table table-bordered table-striped table-hover  dataTable"
                        role="grid" aria-describedby="product_table_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="product_table" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 283px;">No</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 359px;">
                                    Product</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                    Permintaan Rendah</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                    Permintaan Tinggi</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                    Persediaan Sedikit</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">
                                    Persediaan Banyak</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">
                                    Defuzifikasi</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">
                                    Kesimpulan</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                    style="width: 359px;">
                                    @lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $index => $product)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product -> codebar }}</td>
                                <td>{{ $product -> product_name }}</td>
                                <td>{{ $product -> description }}</td>
                                <td>{{ $product -> purchase_price }}</td>
                                <td>{{ $product -> sale_price }}</td>
                                <td>{{ $product -> stock }}</td>
                                <td><img src="{{ $product -> image_path }}" style="width:50px;"
                                        class="img-circle img-thumbnail" alt=""></td>
                                <td>
                                    @if (auth()->user()->hasPermission('update_categories'))
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('product.edit', $product->id) }}"><i class="fas fa-edit"></i>
                                        @lang('site.edit')</a>
                                    @else
                                    <a class="btn btn-warning btn-sm disabled"
                                        href="{{ route('product.edit', $product->id) }}"><i class="fas fa-edit"></i></i>
                                        @lang('site.edit')</a>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete_products'))
                                    <button id="delete" onclick="deletemoderator({{ $product->id }})"
                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                        @lang('site.delete')</button>
                                    <form id="form-delete-{{ $product->id }}"
                                        action="{{ route('product.destroy', $product->id) }}" method="post"
                                        style="display:inline-block;">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                    @else
                                    <button type="submit" class="btn btn-danger btn-sm disabled"><i
                                            class="fas fa-trash"></i>
                                        @lang('site.delete')</button>
                                    @endif

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">No</th>
                                <th rowspan="1" colspan="1">Product</th>
                                <th rowspan="1" colspan="1">Permintaan Rendah</th>
                                <th rowspan="1" colspan="1">Permintaan Tinggi</th>
                                <th rowspan="1" colspan="1">Persediaan Sedikit</th>
                                <th rowspan="1" colspan="1">Persediaan Banyak</th>
                                <th rowspan="1" colspan="1">Defuzifikasi</th>
                                <th rowspan="1" colspan="1">Kesimpulan</th>
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                            </tr>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>





@stop