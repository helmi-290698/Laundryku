<?php

namespace App\Http\Controllers;

use App\DataTables\ConsumentDataTable;
use App\Models\consument;
use Illuminate\Http\Request;
use App\DataTables\LaundryDataTable;
use Yajra\DataTables\Contracts\DataTable;

class ConsumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ConsumentDataTable $datatable)
    {

        $title = "Data Consument";
        return $datatable->render('admin.datakonsumen', ['title' => $title]);
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
     * @param  \App\Models\consument  $consument
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Consument::find($id);
        return $data;
    }
    public function showall()
    {
        $data = Consument::all();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\consument  $consument
     * @return \Illuminate\Http\Response
     */
    public function edit(consument $consument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\consument  $consument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, consument $consument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\consument  $consument
     * @return \Illuminate\Http\Response
     */
    public function destroy(consument $consument)
    {
        //
    }
}
