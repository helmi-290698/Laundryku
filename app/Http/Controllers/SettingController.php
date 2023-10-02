<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Setting';
        $setting = Setting::first();
        return view('admin.setting', ['title' => $title, 'setting' => $setting]);
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
            'company_name' => 'required',
            'no_telepon' => 'required',
            'no_whatsapp' => 'required',
            'address' => 'required',
            'company_logo' => 'image'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['status' => 0, 'error' => $validatedData->errors()]);
        }
        if ($request->file('company_logo')) {
            $files = $request->file('company_logo');
            $name = rand(1, 999);
            $extension = $files->getClientOriginalExtension();
            $newname = $name . '.' . $extension;
            Storage::putFileAs('company-logo', $files, $newname);
            $companyLogo = $newname;
        } else {
            $companyLogo = null;
        }
        Setting::updateOrCreate([
            'id' => $request->id
        ], [
            'company_name' => $request->company_name,
            'no_telepon' => $request->no_telepon,
            'no_whatsapp' => $request->no_whatsapp,
            'address' => $request->address,
            'company_logo' => $companyLogo,
        ]);

        return response()->json(['status' => 1, 'message' => 'Data Added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
