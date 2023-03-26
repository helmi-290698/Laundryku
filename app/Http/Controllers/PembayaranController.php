<?php

namespace App\Http\Controllers;

use App\DataTables\PembayaranDataTable;
use App\Models\Laundry;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PembayaranDataTable $datatable)
    {
        $title = "Data Pembayaran";
        return $datatable->render('admin.datapembayaran', ['title' => $title]);
    }

    public function invoice()
    {
        $title = "Invoice";
        return view('admin.invoice', ['title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }
    public function find($id)
    {
        $data = Pembayaran::find($id);
        return $data;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',

        ]);

        if ($validatedData->fails()) {
            return response()->json(['status' => 0, 'error' => $validatedData->errors()]);
        }

        $pembayaran = [
            'status' => $request->status,
        ];
        Pembayaran::where("id", $request->id)->update($pembayaran);
        return response()->json(['status' => 1, 'message' => 'Update Data sucessfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pembayaran::destroy($id);
        Laundry::where('pembayaran_id', $id)->delete();
        return response()->json(['status' => true, 'message' => 'Delete data Successfully!']);
    }
}
