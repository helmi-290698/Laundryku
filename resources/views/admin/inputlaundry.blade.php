@extends('layouts.app')
@push('plugin-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">{{ $title }}</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Input Laundry</li>
                </ol>
            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/laundry/store') }}" method="post" id="form_input_laundry">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="mb-2">Konsumen Yang Sudah ada :</label>
                                    <div class="col-md-12 col-sm-8 ">
                                        <select name="konsumen" class="form-control select2" id="konsumen">
                                            <option value=" ">-- pilih --</option>
                                        </select>
                                        <span class="text-danger text-error name_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="mb-2">Nama :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="name" placeholder="John doe"
                                            id="example-text-input">
                                        <span class="text-danger text-error name_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-search-input" class="mb-2">No Telepon :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="phone_number"
                                            placeholder="083829907008" id="example-search-input">
                                        <span class="text-danger text-error phone_number_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-email-input" class="mb-2">Email (optional) :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="email" name="email"
                                            placeholder="bootstrap@example.com" id="example-email-input">
                                        <span class="text-danger text-error email_error"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="example-email-input" class="mb-2">Alamat</label>
                                    <div class="col-sm-12">
                                        <textarea name="address" class="form-control" id="" cols="30" rows="8"></textarea>
                                        <span class="text-danger text-error address_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <button type="button" class="btn btn-primary tambah-laundry mb-2 float-end"><i
                                        class="fa fa-plus "></i>&nbsp;Cucian</button>
                            </div>

                        </div>


                        <div class="tambah"></div>



                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="example-text-input" class="mb-2">Diskon</label>
                                        <div class="col-sm-12" id="hitungan">
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control" id='diskon'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="example-text-input" class="mb-2">Biaya Lainnya</label>
                                        <div class="col-sm-12" id="hitungan">
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control" id='biaya_lainya'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="example-text-input" class="mb-2">Total Biaya</label>
                                        <div class="col-sm-12" id="hitungan">
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control" name="total_biaya"
                                                    id='total_biaya' readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="example-text-input" class="mb-2">Tanggal Masuk</label>
                                        <div class="col-sm-12" id="hitungan">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input type="date" class="form-control" name="tanggal_masuk"
                                                    id='tanggal_masuk'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary btn-lg mt-4 float-end">Simpan</button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->


    </div> <!-- end col -->
    </div>
@endsection
@push('plugin-js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        let url = `{{ url('/') }}`;
    </script>
    <script src="{{ asset('assets/js/laundry.js') }}"></script>
@endpush
