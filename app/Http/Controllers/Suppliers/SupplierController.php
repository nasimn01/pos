<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;

use App\Models\Settings\Location\Country;
use App\Models\Settings\Location\Division;
use App\Models\Settings\Location\District;
use App\Models\Suppliers\Supplier;
use App\Models\Settings\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\AddNewRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class SupplierController extends Controller
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
            $suppliers = Supplier::where(company())->paginate(10);
        else
            $suppliers = Supplier::where(company())->where(branch())->paginate(10);

        return view('supplier.index',compact('suppliers'));
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
        return view('supplier.create',compact('countries','divisions','districts','branches'));
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
            $sup= new Supplier;
            $sup->supplier_name= $request->supplierName;
            $sup->companyName= $request->companyName;
            $sup->contact= $request->contact;
            $sup->email= $request->email;
            $sup->phone= $request->phone;
            $sup->tax_number= $request->taxNumber;
            $sup->fax= $request->fax;
            $sup->opening_balance= $request->openingAmount;
            $sup->number_of_due_date= $request->number_of_due_date;
            $sup->country_id= $request->countryName;
            $sup->division_id= $request->divisionName;
            $sup->district_id= $request->districtName;
            $sup->post_code= $request->postCode;
            $sup->post_code= $request->postCode;
            $sup->address= $request->address;
            $sup->branch_id= $request->branch_id;
            $sup->company_id=company()['company_id'];
            //$sup->branch_id?branch()['branch_id']:null;
           
            if($sup->save())
                return redirect()->route(currentUser().'.supplier.index')->with(Toastr::success('Create Successfully!'));
            else
                return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $divisions = Division::all();
        $districts = District::all();
        $branches = Branch::where(company())->get();
        $supplier = Supplier::findOrFail(encryptor('decrypt',$id));
        return view('supplier.edit',compact('countries','divisions','districts','supplier','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $sup= Supplier::findOrFail(encryptor('decrypt',$id));
            $sup->supplier_name= $request->supplierName;
            $sup->companyName= $request->companyName;
            $sup->contact= $request->contact;
            $sup->email= $request->email;
            $sup->phone= $request->phone;
            $sup->tax_number= $request->taxNumber;
            $sup->fax= $request->fax;
            $sup->opening_balance= $request->openingAmount;
            $sup->number_of_due_date= $request->number_of_due_date;
            $sup->country_id= $request->countryName;
            $sup->division_id= $request->divisionName;
            $sup->district_id= $request->districtName;
            $sup->post_code= $request->postCode;
            $sup->post_code= $request->postCode;
            $sup->address= $request->address;
            $sup->branch_id= $request->branch_id;
           
            if($sup->save())
                return redirect()->route(currentUser().'.supplier.index')->with(Toastr::success('Update Successfully!'));
            else
                return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::warning('Please try again!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat= Supplier::findOrFail(encryptor('decrypt',$id));
        $cat->delete();
        return redirect()->back();
    }
}
