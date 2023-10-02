@extends('layouts.app')
@push('plugin-css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting.store') }}" method="post" id="form-setting"
                        enctype="multipart/form-data">
                        <h5 class="h5">1.Company Setting</h5>
                        @csrf
                        <input type="hidden" name="id" class="form-control"
                            value="{{ $setting == null ? '' : $setting->id }}" readonly>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <label for="company name" class="mb-1"> Nama Perusahaan/Toko :</label>
                                <input type="text" name="company_name" id="company_name"
                                    value="{{ $setting == null ? '' : $setting->company_name }}" class="form-control">
                                <span class="text-danger company_name_error"></span>
                            </div>
                            <div class="col-4 mb-2">
                                <label for="no telepon" class="mb-1"> No telepon :</label>
                                <input type="text" name="no_telepon" id="no_telepon"
                                    value="{{ $setting == null ? '' : $setting->no_telepon }}" class="form-control">
                                <span class="text-danger no_telepon_error"></span>
                            </div>
                            <div class="col-4 mb-2">
                                <label for="No Whatsapp" class="mb-1"> No Whatsapp :</label>
                                <input type="text" name="no_whatsapp" id="no_whatsapp"
                                    value="{{ $setting == null ? '' : $setting->no_whatsapp }}" class="form-control">
                                <span class="text-danger no_whatsapp_error"></span>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="Alamat" class="mb-1">Alamat Lengkap :</label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ $setting == null ? '' : $setting->address }}</textarea>
                                <span class="text-danger address_error"></span>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="Logo Perusahaan" class="mb-1">Logo Perusahaan (optional) :</label>
                                <input type="file" name="company_logo" class="form-control">
                                <span class="text-danger company_logo_error"></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg float-end mt-2 mb-2">Simpan</button>

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@push('plugin-js')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        let url = `{{ url('/') }}`;
    </script>
    <script src="{{ asset('assets/js/setting.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
