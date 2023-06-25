<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;

use App\Models\Settings\Location\Country;
use App\Models\Settings\Location\Division;
use App\Models\Settings\Location\District;
use App\Models\Customers\customer;
use App\Models\Settings\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\AddNewRequest;
use App\Http\Requests\Customer\UpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Traits\ResponseTrait;
use Exception;

class CustomerController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( currentUser()=='owner')
            $customers = customer::where(company())->paginate(10);
        else
            $customers = customer::where(company())->where(branch())->paginate(10);

        return view('customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $divisions = Division::all();
        $districts = District::all();
        $branches = Branch::where(company())->get();
        return view('customer.create',compact('countries','divisions','districts','branches'));
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
            $cus= new customer;
            $cus->customer_name= $request->customerName;
            $cus->contact= $request->contact;
            $cus->email= $request->email;
            $cus->phone= $request->phone;
            $cus->tax_number= $request->taxNumber;
            $cus->gst_number= $request->gstNumber;
            $cus->opening_balance= $request->openingAmount;
            $cus->country_id= $request->countryName;
            $cus->division_id= $request->divisionName;
            $cus->district_id= $request->districtName;
            $cus->post_code= $request->postCode;
            $cus->post_code= $request->postCode;
            $cus->address= $request->address;
            $cus->company_id=company()['company_id'];
            $cus->branch_id?branch()['branch_id']:null;
           
            if($cus->save()){
                Toastr::success('Create Successfully!');
                return redirect()->route(currentUser().'.customer.index');
            }else{
                Toastr::warning('Please try Again!');
                return redirect()->back()->withInput();
            }
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customers\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $divisions = Division::all();
        $districts = District::all();
        $branches = Branch::where(company())->get();
        $customer = customer::findOrFail(encryptor('decrypt',$id));
        return view('customer.edit',compact('countries','divisions','districts','customer','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customers\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,$id)
    {
        try{
            $sup= customer::findOrFail(encryptor('decrypt',$id));
            $sup->customer_name= $request->customerName;
            $sup->contact= $request->contact;
            $sup->email= $request->email;
            $sup->phone= $request->phone;
            $sup->tax_number= $request->taxNumber;
            $sup->gst_number= $request->gstNumber;
            $sup->opening_balance= $request->openingAmount;
            $sup->country_id= $request->countryName;
            $sup->division_id= $request->divisionName;
            $sup->district_id= $request->districtName;
            $sup->post_code= $request->postCode;
            $sup->post_code= $request->postCode;
            $sup->address= $request->address;
           
            if($sup->save()){
                Toastr::success('Update Successfully!');
                return redirect()->route(currentUser().'.customer.index');
            }else{
                Toastr::warning('Please try Again!');
                return redirect()->back()->withInput();
            }
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat= customer::findOrFail(encryptor('decrypt',$id));
        $cat->delete();
        return redirect()->back();
    }
}
