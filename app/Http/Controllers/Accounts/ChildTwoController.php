<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;

use App\Models\Accounts\Child_two;
use App\Models\Accounts\Child_one;
use Illuminate\Http\Request;
use App\Http\Requests\Accounts\ChildTwo\AddNewRequest;
use App\Http\Requests\Accounts\ChildTwo\UpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Traits\ResponseTrait;
use Exception;

class ChildTwoController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Child_two::where(company())->paginate(10);
        return view('accounts.child_two.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data= Child_one::where(company())->get();
        return view('accounts.child_two.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
        try{
            $mac = new Child_two();
            $mac->company_id=company()['company_id'];
            $mac->child_one_id= $request->child_one;
            $mac->head_name= $request->head_name;
            $mac->head_code= $request->head_code;
            $mac->opening_balance= $request->opening_balance;

        if($mac->save())
                return redirect()->route(currentUser().'.child_two.index')->with(Toastr::success('Create Successfully!'));
            else
                return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }catch(Exception $e){
            // dd($e);
            return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accounts\Child_two  $child_two
     * @return \Illuminate\Http\Response
     */
    public function show(child_two $child_two)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accounts\child_two  $child_two
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Child_one::where(company())->get();
        $child= Child_two::findOrFail(encryptor('decrypt',$id));
        return view('accounts.child_two.edit',compact('data','child'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accounts\Child_two  $child_two
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $mac = Child_two::findOrFail(encryptor('decrypt',$id));
            $mac->child_one_id= $request->child_one;
            $mac->head_name= $request->head_name;
            $mac->head_code= $request->head_code;
            $mac->opening_balance= $request->opening_balance;

        if($mac->save())
                return redirect()->route(currentUser().'.child_two.index')->with(Toastr::success('Update Successfully!'));
            else
                return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }catch(Exception $e){
            // dd($e);
            return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accounts\Child_two  $child_two
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $child= Child_two::findOrFail(encryptor('decrypt',$id));
        $child->delete();
        return redirect()->back();
    }
}
