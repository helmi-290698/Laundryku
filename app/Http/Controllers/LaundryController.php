<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Itempaket;
use App\Models\Consument;
use App\Models\Laundry;
use App\DataTables\LaundryDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Itempaket::with('item')->get();
        return view('admin.inputlaundry', ['title' => 'Input Laundry', 'items' => $items]);
    }

    public function getharga(request $request)
    {
        if ($request->val == 'reguler') {
            $data =  Itempaket::select("harga_reguler")->where('item_id', '=', $request->item_id)->get();
        } elseif ($request->val == 'oneday') {
            $data =  Itempaket::select("harga_oneday")->where('item_id', '=', $request->item_id)->get();
        } elseif ($request->val == 'express') {
            $data =  Itempaket::select("harga_express")->where('item_id', '=', $request->item_id)->get();
        }
        return $data;
    }

    public function datatablelaundry(LaundryDataTable $datatable)
    {
        return $datatable->render('admin.datalaundry');
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
        $code = random_int(1000000, 9999999);
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone_number' => 'required|min:12|max:13',
            'address' => 'required|max:255',
            'item_id' => 'required',
            'jenis_cucian' => 'required',
            'jumlah' => 'required|numeric',
            'total_biaya' => 'required|numeric'
        ]);

        if ($validatedData->fails()) {
            return response()->json(['status' => 0, 'error' => $validatedData->errors()]);
        }

        $customer = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'code' => $code
        ];



        Consument::create($customer);

        $data = Consument::where('code', $code)->first();

        $laundry = [
            'item_id' => $request->item_id,
            'consument_id' => $data->id,
            'jenis_cucian' => $request->jenis_cucian,
            'jumlah' => $request->jumlah,
            'total_biaya' => $request->total_biaya

        ];

        Laundry::create($laundry);
        return response()->json(['status' => 1, 'message' => 'Data added Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'id_item' => 'required',
            'status' => 'required',

        ]);

        if ($validatedData->fails()) {
            return response()->json(['status' => 0, 'error' => $validatedData->errors()]);
        }

        $laundry = [
            'status' => $request->status,
        ];
        Laundry::where("id", $request->id_item)->update($laundry);
        return response()->json(['status' => 1, 'message' => 'Update Data sucessfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Laundry::destroy($id);
        return response()->json(['status' => true, 'message' => 'Delete data Successfully!']);
    }
}
