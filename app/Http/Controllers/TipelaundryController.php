<?php

namespace App\Http\Controllers;

use App\Models\Tipelaundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DataTables\TipelaundryDataTable;
use Yajra\DataTables\Contracts\DataTable;

class TipelaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TipelaundryDataTable $datatable)
    {
        $title = "Data Tipe Laundry";
        $title_page = "Tipe Laundry";
        return $datatable->render('admin.tipe_laundry', ['title' => $title, 'title_page' => $title_page]);
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
        $validatedData = Validator::make($request->all(), [
            'tipe' => 'required|max:50'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['status' => 0, 'error' => $validatedData->errors()]);
        }
        $tipe = [
            'name_tipe' => $request->tipe
        ];

        Tipelaundry::create($tipe);
        return response()->json(['status' => 1, 'message' => 'Data added Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipelaundry  $tipelaundry
     * @return \Illuminate\Http\Response
     */
    public function show(Tipelaundry $tipelaundry)
    {
        $data = $tipelaundry::all();
        return $data;
    }

    public function getTipeById(Request $request)
    {
        $data = Tipelaundry::find($request->id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipelaundry  $tipelaundry
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipelaundry $tipelaundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipelaundry  $tipelaundry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipelaundry $tipelaundry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipelaundry  $tipelaundry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tipelaundry::destroy($id);
        return response()->json(['status' => true, 'message' => 'Delete data Successfully!']);
    }
}
