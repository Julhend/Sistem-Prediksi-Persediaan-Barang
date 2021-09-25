@extends('layouts.main')


@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <label>Data Tabel Prediksi</label>
            <a type="" class="btn btn-success btn float-right" style="" href="{{ route('prediksi.create') }}"><i
                    class="fas fa-chart-line"></i>
                Buat Prediksi</a>
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
                                    Input Permintaan</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                    Input Persediaan</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 283px;">
                                    Defuzifikasi</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">
                                    Tanggal</th>
                                <th class="sorting" tabindex="0" aria-controls="product_table" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                    style="width: 359px;">
                                    @lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($predict as $index => $predicts)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $predicts->product_name }}</td>
                                <td>{{ $predicts->input_permintaan }}</td>
                                <td>{{ $predicts->input_persediaan }}</td>
                                <td>{{ $predicts->defuzifikasi }}</td>
                                <td>{{ $predicts->created_at }}</td>
                                <td>
                                    <a href="{{ route('prediksi.show', $predicts->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a>


                                    <button id="delete" onclick="deletemoderator({{ $predicts->id }})"
                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    <form id="form-delete-{{ $predicts->id }}"
                                        action="{{ route('prediksi.destroy', $predicts->id) }}" method="post"
                                        style="display:inline-block;">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">No</th>
                                <th rowspan="1" colspan="1">Product</th>
                                <th rowspan="1" colspan="1">Input Permintaan</th>
                                <th rowspan="1" colspan="1">Input Persediaan</th>
                                <th rowspan="1" colspan="1">Defuzifikasi</th>
                                <th rowspan="1" colspan="1">Tanggal</th>
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