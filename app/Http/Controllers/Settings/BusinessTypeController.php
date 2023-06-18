<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use App\Models\Settings\Business_type;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Traits\ImageHandleTraits;
use Exception;

class BusinessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Business_type::paginate(10);
        return view('settings.businesstype.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.businesstype.create');
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
            $data=new Business_type;
            $data->name = $request->name;

            if($data->save()){
            Toastr::success('Create Successfully!');
            return redirect()->route(currentUser().'.business.index');
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
     * @param  \App\Models\Settings\Business_type  $business_type
     * @return \Illuminate\Http\Response
     */
    public function show(Business_type $business_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings\Business_type  $business_type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Business_type::findOrFail(encryptor('decrypt',$id));
        return view('settings.businesstype.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings\Business_type  $business_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $data= Business_type::findOrFail(encryptor('decrypt',$id));
            $data->name = $request->name;

            if($data->save()){
            Toastr::success('Update Successfully!');
            return redirect()->route(currentUser().'.business.index');
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings\Business_type  $business_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business_type $business_type)
    {
        //
    }
}
