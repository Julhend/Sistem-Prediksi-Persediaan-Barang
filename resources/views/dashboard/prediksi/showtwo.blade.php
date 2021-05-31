<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/app.css">
    <style>
        body {
            background-color: #ff
        }

        .padding {
            padding: 2rem !important
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2
        }

        h3 {
            font-size: 20px
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium'
        }

        .text-dark {
            color: #3d405c !important
        }

        .fix-footer {
            position: fixed;
            left: 0px;
            bottom: 0px;
            height: 35px;
            width: 100%;
            background: #1abc9c;
        }

        .head-dark {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55;
        }

        table.table-bordered {
            border: 2px solid #000000;
            border-radius: 10px;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 2px solid #000000;
            border-radius: 10px;
        }

        .too-border {
            padding: 2px;
            border: 2px solid #000000;
            border-radius: 10px;
            margin: 5px 0;
        }

        .table th,
        .table td {
            padding: 0.25rem;
        }

        @media print {

            .table thead tr td,
            .table tbody tr td,
            .table thead tr th,
            .table tbody tr th {
                border-width: 1px !important;
                border-style: solid !important;
                border-color: black !important;
                -webkit-print-color-adjust: exact;
            }

            .col-print-1 {
                width: 8%;
                float: left;
            }

            .col-print-2 {
                width: 16%;
                float: left;
            }

            .col-print-3 {
                width: 25%;
                float: left;
            }

            .col-print-4 {
                width: 33%;
                float: left;
            }

            .col-print-5 {
                width: 42%;
                float: left;
            }

            .col-print-6 {
                width: 50%;
                float: left;
            }

            .col-print-7 {
                width: 58%;
                float: left;
            }

            .col-print-8 {
                width: 66%;
                float: left;
            }

            .col-print-9 {
                width: 75%;
                float: left;
            }

            .col-print-10 {
                width: 83%;
                float: left;
            }

            .col-print-11 {
                width: 92%;
                float: left;
            }

            .col-print-12 {
                width: 100%;
                float: left;
            }

            html,
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .too-footer {
                position: absolute;
                bottom: 0;
            }
        }
    </style>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            {{-- <div class="card-header p-4" style="border: 2px solid #000000;border-radius: 10px;">
                <img src="{{ asset('/uploads/settings/'.$logo) }}" style="width:200px;" alt="" srcset="">
            <div class="float-right text-center">
                <h3 class="mb-0">{{ $store_name }}</h3>
                Address : {{ $address }} <br>Phone : {{ $phone }}
            </div>
        </div> --}}
        <div class="card-body" style="padding: 0;">
            <div class="text-center too-border">
                <h4>Laporan Hasil Prediksi Barang</h4>
            </div>
            {{-- <div class="row">
                <div class="col-md-6 col-print-6 text-center">
                    <div class="too-border">
                        <h4> Date: <span style="font-size:15px">{{ date_format($purchase->created_at,"d/m/Y") }}</span>
            </h4>

            <h4>Admin : <span style="font-size:15px">{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</span> </h4>
        </div>
    </div>
    <div class="col-md-6 col-print-6 text-center">
        <div class="too-border">
            <h4>Supplier Information</h4>
        </div>
        <div class="too-border">
            Supplier Name : {{ $provider_purchases->provider_name }}<br>Address :
            {{ $provider_purchases->address }}
            <br>Phone : {{ $provider_purchases->phone }}
        </div>
    </div> --}}
    </div>
    <div class="table-responsive-sm">
        <table class="table table-bordered" style="margin-bottom: 1;">
            <thead>
                <tr>
                    <th style="width: 100px;">Product</th>
                    <th style="width: 100px;text-align:center;">Input Persediaan</th>
                    <th style="width: 100px;text-align:center;">Input Permintaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($predict as $index => $predicts)
                <tr>

                    <td>{{ $predicts->product_name }}</td>
                    <td>{{ $predicts->input_persediaan }}</td>
                    <td>{{ $predicts->input_permintaan }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table table-bordered" style="margin-bottom: 1;">
            <thead>
                <tr>
                    <th style="width: 100px;">Permintaan Rendah</th>
                    <th style="width: 100px;">Permintaan Tinggi</th>
                    <th style="width: 100px;text-align:center;">Persediaan Sedikit</th>
                    <th style="width: 100px;text-align:center;">Persediaan Banyak</th>
                    <th style="width: 100px;text-align:center;">Pembelian Berkurang</th>
                    <th style="width: 100px;text-align:center;">Pembelian Bertambah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{number_format( $predicts->permintaan_rendah,3) }}</td>
                    <td>{{number_format($predicts->permintaan_tinggi,3) }}</td>
                    <td>{{number_format($predicts->persediaan_sedikit,3) }}</td>
                    <td>{{number_format($predicts->persediaan_banyak,3) }}</td>
                    <td>{{number_format($predicts->pembelian_berkurang) }}</td>
                    <td>{{number_format($predicts->pembelian_bertambah) }}</td>
                </tr>

            </tbody>
        </table>
        <div class="float-right text-left" style="width:25%">
            <div class="too-border">
                <strong>
                    {{-- Subtotal :
                                Rp.{{ number_format($purchase->total,2) }}<br>Discount : --}}
                    {{-- Rp.{{ number_format($purchase->discount,2) }}
                    <br>Total amount :
                    Rp.{{ number_format($purchase->total_amount,2) }}<br>Payment :
                    Rp.{{ number_format($purchase->paid,2) }}
                    <br>Rest a payer :
                    Rp.{{ number_format($purchase->total_amount - $purchase->paid,2) }} --}}
                </strong>
            </div>
        </div>
    </div>

    </div>
    </div>

    </div>
    </div>
    <div class="too-footer offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="too-border text-center">
            <p class="mb-0">{{ $predicts->kesimpulan }}
            </p>
        </div>
    </div>
</body>

</html>