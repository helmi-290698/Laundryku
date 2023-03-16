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

        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Input Item Paket </h4>
                    <form action="{{ url('/item_paket') }}" method="post" id="form-tambah-item-paket">
                        @csrf
                        <label for="nama_paket" class="form-label">Nama Paket</label>
                        <select name="item_id" id="item" class="form-select">

                        </select><br>
                        <span class="text-danger text-error id_item_error"></span>
                        <div id="harga">

                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>

                </div>

            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="row ">
                        <h4 class="card-title">Data Item Paket</h4>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-update-itempaket" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('/item_paket/edit') }}" class="update-item-paket" id="form-ubah-item-paket"
                        method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Item Laundry
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" class="form-control" id="itempaket_id">
                            <input type="hidden" name="id_item" class="form-control" id="id_item">
                            <label for="hitungan">Hitungan</label>

                            <select class="form-select" name="name_item" id="itempaket_select" disabled>
                                <option>-- Pilih Lembaga --</option>
                                @foreach ($item_paket as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                                @endforeach
                            </select><br>
                            <label for="harga_reguler">Harga Reguler</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="harga_reguler" class="form-control" id="harga_reguler">
                            </div>
                            <span class="text-danger text-error harga_reguler_error"></span>
                            <br>
                            <label for="harga_oneday">Harga One Day</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="harga_oneday" class="form-control" id="harga_oneday">
                            </div>
                            <span class="text-danger text-error harga_oneday_error"></span>
                            <br>
                            <label for="harga_express">Harga Express</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="harga_express" class="form-control" id="harga_express">
                            </div>
                            <span class="text-danger text-error harga_express_error"></span>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-update-itempaket-permeter" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('/item_paket/edit') }}" class="update-item-paket" id="form-ubah-item-paket"
                        method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Item Laundry
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" class="form-control" id="itempaket_id_permeter">
                            <input type="hidden" name="id_item" class="form-control" id="id_item_permeter">
                            <label for="hitungan">Hitungan</label>
                            <select class="form-select" name="name_item" id="itempaket_select" disabled>
                                <option>-- Pilih Lembaga --</option>
                                @foreach ($item_paket as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                                @endforeach
                            </select><br>
                            <label for="harga_reguler">Harga Reguler</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="harga_reguler" class="form-control"
                                    id="harga_reguler_permeter">
                            </div>
                            <span class="text-danger text-error harga_reguler_error"></span>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        let url = `{{ url('/') }}`;
    </script>
    <script src="{{ asset('assets/js/item_paket.js') }}"></script>

    {!! $dataTable->scripts() !!}
@endpush
