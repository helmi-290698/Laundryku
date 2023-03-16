<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemDataTable $datatable)
    {
        $title = "Data Item Laundry";
        return $datatable->render('admin.item_laundry', ['title' => $title]);
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
        $validatedData = validator::make($request->all(), [
            'name_item' => 'required|max:255',
            'hitungan' => 'required',
            'tipelaundry_id' => 'required'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['status' => 0, 'error' => $validatedData->errors()]);
        }
        $data = [
            'name_item' => $request->name_item,
            'hitungan' => $request->hitungan,
            'tipelaundry_id' => $request->tipelaundry_id
        ];
        Item::create($data);
        return response()->json(['status' => 1, 'message' => 'Data Added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $data = Item::all();

        return $data;
    }
    public function getItemByIdtipe(Request $request)
    {
        $data = item::with('itempaket')->where('tipelaundry_id', '=', $request->id)->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(request $id)
    {
        $data = Item::find($id->id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name_item' => 'required|max:255',
            'hitungan' => 'required'
        ]);
        Item::where("id", $request->id_item)->update($validatedData);
        return redirect('/item_laundry');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        Item::destroy($post);
        return redirect('/item_laundry');
    }
}
