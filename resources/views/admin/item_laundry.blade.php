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
                    <form action="{{ url('/item_laundry/store') }}" method="post" id="form-tambah-item-laundry">
                        @csrf
                        <label for="name_item" class="form-label">Nama Item Laundry</label>
                        <input type="text" class="form-control" name="name_item" id="name_item"
                            placeholder="Nama Item Laundry">
                        <span class="text-danger text-error name_item_error"></span>
                        <br>
                        <label for="hitungan" class="form-label">Tipe Laundry</label>
                        <select name="tipelaundry_id" id="tipe_laundry" class="form-select">
                            <option value=" ">--pilih--</option>
                        </select>
                        <span class="text-danger text-error tipelaundry_id_error"></span>
                        <br>
                        <label for="hitungan" class="form-label">Hitungan</label>
                        <select name="hitungan" id="hitungan" class="form-select">
                            <option value=" ">--pilih--</option>
                            <option value="peritem">Per Item</option>
                            <option value="permeter">Per Meter</option>
                            <option value="perkilo">Per Kilo</option>
                        </select>
                        <span class="text-danger text-error hitungan_error"></span>
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm"> Simpan </button>

                    </form>

                </div>

            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Data Item Laundry</h4>




                    {!! $dataTable->table() !!}


                </div>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/item_laundry/edit') }}" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Item Laundry
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="id_item" class="form-control" id="id_item"><br>
                                <label for="nama_item">Nama Item</label>
                                <input type="text" name="name_item" class="form-control" id="nama_item" required><br>
                                <label for="hitungan">Hitungan</label>
                                <select name="hitungan" id="hitungan_select" class="form-select" required>
                                    <option value="peritem">Per Item</option>
                                    <option value="permeter">Per Meter</option>
                                    <option value="perkilo">Per Kilo</option>
                                </select>
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
    <script src="{{ asset('assets/js/item_laundry.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    {!! $dataTable->scripts() !!}
@endpush
