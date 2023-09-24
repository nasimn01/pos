<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;

use App\Models\Sales\Sales;
use App\Models\Stock\Stock;
use App\Models\Sales\Sales_details;
use Illuminate\Http\Request;
use App\Models\Settings\Branch;
use App\Models\Settings\Warehouse;
use App\Models\Settings\Company;
use App\Models\Customers\customer;
use App\Models\Products\Product;
use App\Http\Requests\Sales\AddNewRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Traits\ResponseTrait;
use Exception;
use DB;

class SalesController extends Controller
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
            $sales = Sales::where(company())->paginate(10);
        else
            $sales = Sales::where(company())->where(branch())->paginate(10);
            
        
        return view('sales.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where(company())->get();
        if( currentUser()=='owner'){
            $customers = customer::where(company())->get();
            $Warehouses = Warehouse::where(company())->get();
        }else{
            $customers = customer::where(company())->where(branch())->get();
            $Warehouses = Warehouse::where(company())->where(branch())->get();
        }
        
        return view('sales.create',compact('branches','customers','Warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_sc(Request $request)
    {
        if($request->name){
            if($request->oldpro)
                $product=DB::select("SELECT products.id,product_prices.price,products.product_name,product_prices.barcode,sum(stocks.quantity) as qty FROM `product_prices`
                                     JOIN products on products.id=product_prices.product_id
                                     JOIN stocks on stocks.product_id=product_prices.product_id
                                    WHERE 
                                    stocks.company_id=".company()['company_id']." and
                                    stocks.branch_id=".$request->branch_id." and
                                    stocks.warehouse_id=".$request->warehouse_id." and
                                    (products.product_name like '%". $request->name ."%' or product_prices.barcode like '%". $request->name ."%') and
                                    product_prices.barcode not in (".rtrim($request->oldpro,',').")
                                    GROUP BY product_prices.barcode");
            else
                $product=DB::select("SELECT products.id,product_prices.price,products.product_name,product_prices.barcode,sum(stocks.quantity) as qty FROM `product_prices`
                                    JOIN products on products.id=product_prices.product_id
                                    JOIN stocks on stocks.product_id=product_prices.product_id
                                    WHERE 
                                    stocks.company_id=".company()['company_id']." and
                                    stocks.branch_id=".$request->branch_id." and
                                    stocks.warehouse_id=".$request->warehouse_id." and
                                    (products.product_name like '%". $request->name ."%' or product_prices.barcode like '%". $request->name ."%') 
                                    GROUP BY product_prices.barcode");
            
            print_r(json_encode($product));  
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_sc_d(Request $request)
    {
        if($request->barcode){
            $product=collect(\DB::select("SELECT products.id,product_prices.price,products.product_name,product_prices.barcode,sum(stocks.quantity) as qty FROM `product_prices` JOIN products on products.id=product_prices.product_id
            JOIN stocks on stocks.product_id=product_prices.product_id WHERE stocks.company_id=".company()['company_id']." and stocks.branch_id=".$request->branch_id." and stocks.warehouse_id=".$request->warehouse_id." and product_prices.barcode='".$request->barcode."' GROUP BY products.id"))->first();
            
            $data='<tr class="productlist">';
            $data.='<td class="p-2">'.$product->product_name.'<input name="product_id[]" type="hidden" value="'.$product->id.'" class="product_id_list">
                        <input type="hidden" value="'.$product->barcode.'" class="barcode_list">
                        <input name="stockqty[]" type="hidden" value="'.$product->qty.'" class="stockqty"></td>';
            $data.='<td class="p-2"><input onkeyup="get_cal(this)" name="qty[]" type="text" class="form-control qty" value="0"></td>';
            $data.='<td class="p-2"><input onkeyup="get_cal(this)" name="price[]" type="text" class="form-control price" value="'.$product->price.'"></td>';
            $data.='<td class="p-2"><input onkeyup="get_cal(this)" name="tax[]" type="text" class="form-control tax" value=""></td>';
            $data.='<td class="p-2">
                        <select onchange="get_cal(this)" class="form-control form-select mt-2 discount_type" name="discount_type[]">
                            <option value="0">%</option>
                            <option value="1">Fixed</option>
                        </select>
                    </td>';
            $data.='<td class="p-2"><input onkeyup="get_cal(this)" name="discount[]" type="text" class="form-control discount" value="0"></td>';
            $data.='<td class="p-2"><input name="unit_cost[]" readonly type="text" class="form-control unit_cost" value="0"></td>';
            $data.='<td class="p-2"><input name="subtotal[]" readonly type="text" class="form-control subtotal" value="0"></td>';
            $data.='<td class="p-2 text-danger"><i style="font-size:1.7rem" onclick="removerow(this)" class="bi bi-dash-circle-fill"></i></td>';
            $data.='</tr>';
            
            print_r(json_encode($data));  
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
       
        DB::beginTransaction();
        try{
            $pur= new Sales;
            $pur->customer_id=$request->customerName;
            $pur->sales_date=$request->sales_date;
            $pur->reference_no=$request->reference_no;
            $pur->total_quantity=$request->total_qty;
            $pur->sub_amount=$request->tsubtotal;
            $pur->discount_type=$request->discount_all_type;
            $pur->discount=$request->discount_all;
            $pur->other_charge=$request->tother_charge;
            $pur->round_of=$request->troundof;
            $pur->grand_total=$request->tgrandtotal;
            $pur->note=$request->note;
            $pur->company_id=company()['company_id'];
            $pur->branch_id=$request->branch_id;
            $pur->warehouse_id=$request->warehouse_id;
            $pur->created_by=currentUserId();

            $pur->payment_status=0;
            $pur->status=1;
            if($pur->save()){
                if($request->product_id){
                    foreach($request->product_id as $i=>$product_id){
                        $pd=new sales_details;
                        $pd->sales_id=$pur->id;
                        $pd->product_id=$product_id;
                        $pd->quantity=$request->qty[$i];
                        $pd->unit_price=$request->price[$i];
                        $pd->tax=$request->tax[$i]>0?$request->tax[$i]:0;
                        
                        $pd->discount_type=$request->discount_type[$i];
                        $pd->discount=$request->discount[$i];
                        $pd->sub_amount=$request->unit_cost[$i];
                        $pd->total_amount=$request->subtotal[$i];
                        if($pd->save()){
                            $stock=new Stock;
                            $stock->product_id=$product_id;
                            $stock->purchase_id=$pur->id;
                            $stock->company_id=company()['company_id'];
                            $stock->branch_id=$request->branch_id;
                            $stock->warehouse_id=$request->warehouse_id;
                            $stock->quantity='-'.$pd->quantity;
                            $stock->unit_price=($pd->total_amount / $pd->quantity);
                            $stock->tax=$pd->tax;
                            $stock->discount=$pd->discount;
                            $stock->save();

                            DB::commit();
                        }

                    }
                }
                Toastr::success('Create Successfully!');
                return redirect()->route(currentUser().'.sales.index');
            }else
                Toastr::warning('Please try again');
                return redirect()->back()->withInput();
        }catch(Exception $e){
            Toastr::warning('Please try again');
            DB::rollback();
            dd($e);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
