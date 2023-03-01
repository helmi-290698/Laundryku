<?php

namespace App\Http\Controllers;

use App\Models\Itempaket;
use App\Models\Item;
use Illuminate\Http\Request;
use App\DataTables\ItempaketDataTable;
use Illuminate\Support\Facades\Validator;

class ItempaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItempaketDataTable $datatable)
    {
        return $datatable->render('admin.item_paket');
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

        $data = Item::find($request->item_id);

        if ($data->hitungan == "peritem") {
            $validatedData = Validator::make($request->all(), [
                'item_id' => 'required',
                'harga_reguler' => 'required',
                'harga_oneday' => 'required',
                'harga_express' => 'required'
            ]);
        } elseif ($data->hitungan == "perkilo") {
            $validatedData = Validator::make($request->all(), [
                'item_id' => 'required',
                'harga_reguler' => 'required',
                'harga_oneday' => 'required',
                'harga_express' => 'required'
            ]);
        } elseif ($data->hitungan == "permeter") {
            $validatedData = Validator::make($request->all(), [
                'item_id' => 'required',
                'harga_reguler' => 'required',
            ]);
        }

        if ($validatedData->fails()) {
            return response()->json(['status' => 0, 'error' => $validatedData->errors()]);
        }
        $itempaket = [
            'item_id' => $request->item_id,
            'harga_reguler' => $request->harga_reguler,
            'harga_oneday' => $request->harga_oneday,
            'harga_express' => $request->harga_express
        ];

        Itempaket::create($itempaket);
        return response()->json(['status' => 1, 'message' => 'Data added Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itempaket  $itempaket
     * @return \Illuminate\Http\Response
     */
    public function show(Itempaket $itempaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Itempaket  $itempaket
     * @return \Illuminate\Http\Response
     */
    public function edit(Itempaket $itempaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Itempaket  $itempaket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itempaket $itempaket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itempaket  $itempaket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Itempaket::destroy($id);
        return response()->json(['status' => true, 'message' => 'Delete data Successfully!']);
    }
}
