<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use App\Models\Settings\Package;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Traits\ImageHandleTraits;
use Exception;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Package::all();
        return view('settings.package.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data=new Package;
            $data->package_name = $request->package_name;
            $data->package_day = $request->package_day;
            $data->price = $request->price;
            $data->package_feature = implode(',', $request->input('package_feature', []));
            $data->package_code = $request->package_code;
            $data->status=1;

            if($data->save()){
            Toastr::success('Create Successfully!');
            return redirect()->route(currentUser().'.package.index');
            } else{
            Toastr::warning('Please try Again!');
             return redirect()->back();
            }

        }
        catch (Exception $e){
            // dd($e);
            return back()->withInput();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Package::findOrFail(encryptor('decrypt',$id));
        $packageFeatures = explode(',', $data->package_feature);
        return view('settings.package.edit',compact('data','packageFeatures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $data= Package::findOrFail(encryptor('decrypt',$id));
            $data->package_name = $request->package_name;
            $data->package_day = $request->package_day;
            $data->price = $request->price;
            $data->package_feature = implode(',', $request->input('package_feature', []));
            $data->package_code = $request->package_code;
            $data->status=1;

            if($data->save()){
            Toastr::success('Update Successfully!');
            return redirect()->route(currentUser().'.package.index');
            } else{
            Toastr::warning('Please try Again!');
             return redirect()->back();
            }

        }
        catch (Exception $e){
            dd($e);
            return back()->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
