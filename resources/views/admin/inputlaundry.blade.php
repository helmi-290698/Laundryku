@extends('layouts.app')
@section('plugin-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">{{ $title }}</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Veltrix</a></li>
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Datatable</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    <div class="dropdown">
                        <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-cog me-2"></i> Settings
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </div>
                </div>
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
                                    <label for="example-text-input" class="mb-2">Nama</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="name" placeholder="John doe"
                                            id="example-text-input">
                                        <span class="text-danger text-error name_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-search-input" class="mb-2">No Telepon</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="phone_number"
                                            placeholder="083829907008" id="example-search-input">
                                        <span class="text-danger text-error phone_number_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-email-input" class="mb-2">Email (optional)</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="email" name="email"
                                            placeholder="bootstrap@example.com" id="example-email-input">
                                        <span class="text-danger text-error email_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-email-input" class="mb-2">Alamat</label>
                                    <div class="col-sm-12">
                                        <textarea name="address" class="form-control" id="" cols="30" rows="9"></textarea>
                                        <span class="text-danger text-error address_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="mb-2">Tipe laundry</label>
                                    <div class="col-sm-12">
                                        <select name="tipelaundry_id" class="form-select" id="tipelaundry_id">
                                            <option value=" ">-- pilih --</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="mb-2">Jenis Item</label>
                                    <div class="col-sm-12">
                                        <select name="item_id" class="form-select" id="jenis_item">
                                            <option value=" ">-- pilih --</option>

                                        </select>
                                        <span class="text-danger text-error item_id_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="mb-2">Jenis Cucian</label>
                                    <div class="col-sm-12">
                                        <select name="jenis_cucian" class="form-select" id="jenis_cucian">
                                            <option value=" ">-- pilih --</option>

                                        </select>
                                        <span class="text-danger text-error jenis_cucian_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="mb-2">Jumlah Laundry</label>
                                    <div class="col-sm-12" id="hitungan">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" id='harga' readonly>
                                            <span class="input-group-text">X</span>
                                            <input type="text" class="form-control" name="jumlah" min='0'
                                                id="jumlah_laundry">
                                            <span class="input-group-text">Kg-M-Item</span>

                                        </div>
                                        <span class="text-danger text-error jumlah_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="mb-2">Biaya Laundry</label>
                                    <div class="col-sm-12" id="hitungan">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" id='biaya_laundry' disabled>
                                        </div>
                                    </div>
                                </div>
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
                                    <label for="example-text-input" class="mb-2">Total Biaya</label>
                                    <div class="col-sm-12" id="hitungan">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" name="total_biaya"
                                                id='total_biaya' readonly>
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
@section('plugin-js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        let url = `{{ url('/') }}`;
    </script>
    <script src="{{ asset('assets/js/laundry.js') }}"></script>
@endsection
