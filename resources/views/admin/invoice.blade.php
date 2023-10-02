@extends('layouts.app')
@push('plugin-css')
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="print">
@endpush
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">{{ $title }}</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    <div class="dropdown">
                        <button class="btn btn-primary" type="button" id="cetak">
                            Cetak
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-body" id="data">
                    <h4 class="text-center">
                        Jarina Laundry</h4>
                    <p class="text-center mb-0"> Jl. Kol A Syam Komplek Puri Indah Rw 07 Cikeruh Jatinangor Sumedang </p>
                    <p class="text-center">HP/WA :
                        081211243356, 087718320777</p>
                    <hr />
                    <div class="row">
                        <div class="col-6">
                            <h6> Order ID</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">TRX/083377/2023</h6>
                        </div>
                        <div class="col-6">
                            <h6> Pelanggan</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">{{ $laundry->pembayaran->consument->name }}</h6>
                        </div>
                        <div class="col-6">
                            <h6> Tgl Pesan </h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">{{ $laundry->pembayaran->tanggal_masuk }}</h6>
                        </div>
                        <div class="col-6">
                            <h6> Tgl Selesai</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">0</h6>
                        </div>
                        <hr />
                        <div class="col-12 ">
                            <h6 class="mb-0">{{ $laundry->item->name_item }} {{ $laundry->jenis_cucian }} 3 Hari</h6>
                        </div>
                        <div class="col-6">
                            <p>{{ $laundry->jumlah }} X {{ $biaya_item }}</p>
                        </div>
                        <div class="col-6">
                            <p class="float-end">{{ $laundry->biaya_laundry }}</p>
                        </div>
                        <hr />
                        <div class="col-6">
                            <h6> Biaya Laundry</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">{{ $laundry->biaya_laundry }}</h6>
                        </div>
                        <div class="col-6">
                            <h6> Biaya Lainya</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">{{ $laundry->pembayaran->biaya_lainya }}</h6>
                        </div>
                        <div class="col-6">
                            <h6> Diskon</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">{{ $laundry->pembayaran->diskon }}</h6>
                        </div>
                        <div class="col-6">
                            <h6> Dibayar</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">0</h6>
                        </div>
                        <div class="col-6">
                            <h6> Total Biaya</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="float-end">{{ $total_biaya }}</h6>
                        </div>
                        <hr />
                        <div class="col-12">
                            <h6>Catatan : Saat Pengambilan barang sertakan struk pengambilan</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@push('plugin-js')
    <script>
        let url = `{{ url('/') }}`;
    </script>
    <script src="{{ asset('plugins/printarea/demo/jquery.PrintArea.js') }}"></script>
    <script>
        (function($) {
            // fungsi dijalankan setelah seluruh dokumen ditampilkan
            $(document).ready(function(e) {

                // aksi ketika tombol cetak ditekan
                $("#cetak").bind("click", function(event) {
                    // cetak data pada area <div id="#data-mahasiswa"></div>
                    $('#data').printArea();
                });
            });
        })(jQuery);
    </script>
@endpush
