@extends('layout.app')

@section('pageTitle',trans('Create PO'))
@section('pageSubTitle',trans('Create'))

@section('content')
<section id="multiple-column-form">
    <div class="match-height">
        <div class="card">
            <div class="card-tabs">
                <a class="card-tab active" href="{{route(currentUser().'.purchaseOrder.create')}}">Add New</a>
                <a class="card-tab " href="{{route(currentUser().'.purchaseOrder.index')}}">List</a>
            </div>
            <div class="card-content mt-5">
                <div class="card-body">
                    <form class="form" method="post" action="{{route(currentUser().'.purchaseOrder.store')}}">
                        @csrf
                        <div class="row">
                            @if( currentUser()=='owner')
                                <div class="col-md-2 mt-2">
                                    <label for="branch_id" class="float-end" ><h6>Branches Name<span class="text-danger">*</span></h6></label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <select required onchange="change_data(this.value)" class="form-control form-select" name="branch_id" id="branch_id">
                                        <option value="">Select Branches</option>    
                                        @forelse($branches as $b)
                                            <option value="{{ $b->id }}" {{old('branch_id')==$b->id?'selected':''}}>{{ $b->name }}</option>
                                        @empty
                                            <option value="">No branch found</option>
                                        @endforelse          
                                    </select>      
                                </div>
                                @if($errors->has('branch_id'))
                                    <span class="text-danger"> {{ $errors->first('branch_id') }}</span>
                                @endif
                                
                            @else
                                <input type="hidden" value="{{ branch()['branch_id']}}" name="branch_id">
                            @endif
                            
                                
                            <div class="col-md-2 mt-2">
                                <label for="supplierName" class="float-end"><h6>Supplier<span class="text-danger">*</span></h6></label>
                            </div>
                            <div class="col-md-4">
                                
                                <select required class="form-control form-select" name="supplierName" id="supplierName">
                                    <option value="">Select Supplier</option>
                                    @forelse($suppliers as $d)
                                        <option class="brnch brnch{{$d->branch_id}}" value="{{$d->id}}" {{ old('supplierName')==$d->id?"selected":""}}> {{ $d->supplier_name}}</option>
                                    @empty
                                        <option value="">No Supplier found</option>
                                    @endforelse
                                </select>
                            </div>
                            
                            @if($errors->has('supplierName'))
                            <span class="text-danger"> {{ $errors->first('supplierName') }}</span>
                            @endif


                            <div class="col-md-2 mt-2">
                                <label for="warehouse_id" class="float-end"><h6>Warehouse<span class="text-danger">*</span></h6></label>
                            </div>
                            <div class="col-md-4">
                                <select required class="form-control form-select" name="warehouse_id" id="warehouse_id">
                                    <option value="">Select Warehouse</option>
                                    @forelse($Warehouses as $d)
                                        <option class="brnch brnch{{$d->branch_id}}" value="{{$d->id}}" {{ old('warehouse_id')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                    @empty
                                        <option value="">No Warehouse found</option>
                                    @endforelse
                                </select>
                            </div>
                            
                            @if($errors->has('warehouse_id'))
                                <span class="text-danger"> {{ $errors->first('warehouse_id') }}</span>
                            @endif 
                            

                            <div class="col-md-2 mt-2">
                                <label for="date" class="float-end"><h6>Date<span class="text-danger">*</span></h6></label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="datepicker" class="form-control" value="{{ old('purchase_order_date')}}" name="purchase_order_date" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-8 offset-2">
                                <input type="text" name="" id="item_search" class="form-control  ui-autocomplete-input" placeholder="Search Product">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 table-responsive">
                                <table class="table mb-5">
                                    <thead>
                                        <tr class="bg-primary text-white text-center">
                                            <th class="p-2">Product Name</th>
                                            <th class="p-2">Unit</th>
                                            <th class="p-2">Quantity</th>
                                            <th class="p-2">Purchase Price</th>
                                            <th class="p-2">Tax %</th>
                                            <th class="p-2">Discount Type</th>
                                            <th class="p-2">Discount</th>
                                            <th class="p-2">Unit Cost</th>
                                            <th class="p-2">Total Amount</th>
                                            <th class="p-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details_data">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <td class="total_quantity"></td>
                                            <th colspan="3"></th>
                                            <th class="total_discount"></th>
                                            <th></th>
                                            <th class="total_amount"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
    function change_data(e){
        $('.brnch').hide();
        $('.brnch'+e).show();
    }
</script>

<script>
    $(function() {
        $("#item_search").bind("paste", function(e){
            $("#item_search").autocomplete('search');
        } );
        $("#item_search").autocomplete({
            source: function(data, cb){
                
                $.ajax({
                autoFocus:true,
                    url: "{{route(currentUser().'.pur.product_search')}}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        name: data.term
                    },
                    success: function(res){
                        var result;
                        result = [{label: 'No Records Found ',value: ''}];
                        if (res.length) {
                            result = $.map(res, function(el){
                                return {
                                    label: el.value +'-'+ el.label,
                                    value: '',
                                    id: el.id,
                                    item_name: el.value
                                };
                            });
                        }

                        cb(result);
                    },error: function(e){
                        console.log("error "+e);
                    }
                });
            },

                response:function(e,ui){
                    if(ui.content.length==1){
                        $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete("close");
                    }
                    //console.log(ui.content[0].id);
                },

                //loader start
                search: function (e, ui) {},
                select: function (e, ui) { 
                    if(typeof ui.content!='undefined'){
                        console.log("Autoselected first");
                        if(isNaN(ui.content[0].id)){
                            return;
                        }
                        var item_id=ui.content[0].id;
                    }
                    else{
                        console.log("manual Selected");
                        var item_id=ui.item.id;
                    }

                    return_row_with_data(item_id);
                    $("#item_search").val('');
                },   
                //loader end
        });


    });

    function return_row_with_data(item_id){
    $("#item_search").addClass('ui-autocomplete-loader-center');
        $.ajax({
            autoFocus:true,
            url: "{{route(currentUser().'.pur.po_product_search_data')}}",
            method: 'GET',
            dataType: 'json',
            data: {item_id: item_id},
            success: function(res){
                $('#details_data').append(res);
                $("#item_search").val('');
                $("#item_search").removeClass('ui-autocomplete-loader-center');
            },error: function(e){console.log("error "+e);}
        });
        
    }
    //INCREMENT ITEM
    function removerow(e){
    $(e).parents('tr').remove();
    }

    //CALCUALATED SALES PRICE
    function get_cal(e){
    var purchase_price = (isNaN(parseFloat($(e).parents('tr').find('.price').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.price').val().trim()); 
    var qty = (isNaN(parseFloat($(e).parents('tr').find('.qty').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.qty').val().trim()); 
    var tax = (isNaN(parseFloat($(e).parents('tr').find('.tax').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.tax').val().trim()); 
    var discount_type = parseFloat($(e).parents('tr').find('.discount_type').val().trim()); 
    var discount = (isNaN(parseFloat($(e).parents('tr').find('.discount').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.discount').val().trim()); 
    
    if(discount_type=="0")
        discount=(purchase_price*(discount/100));

        tax=((purchase_price ) *(tax/100));

        $(e).parents('tr').find('.discount_cal').val(discount)
        $(e).parents('tr').find('.tax_cal').val(tax)

    var unit_cost = ((purchase_price + tax));
    var subtotal = ((unit_cost * qty) - (discount * qty));

    $(e).parents('tr').find('.unit_cost').val(unit_cost);
    $(e).parents('tr').find('.subtotal').val(subtotal);
    total_calculate();
    }
    //END
    //CALCULATE PROFIT MARGIN PERCENTAGE
    function total_calculate(){
        var totalqty = 0;
        $('.qty').each(function(e){
            totalqty += parseFloat($(this).val());
        });

        $(".total_qty").text(totalqty);
        $(".total_qty_p").val(totalqty);
    }
    //END

    function cal_grandtotl(){
        var tdiscount_p=(isNaN(parseFloat($('.tdiscount_p').val().trim()))) ? 0 :parseFloat($('.tdiscount_p').val().trim());
        var grandtotal=((tsubtotal_p+other_charge)-tdiscount_p);
        var roundof=Math.floor(grandtotal);

        subtotal_diff=grandtotal-roundof;
        
            $(".troundof").html(parseFloat(subtotal_diff).toFixed(2)); 
            $(".troundof_p").val(parseFloat(subtotal_diff).toFixed(2)); 
            $(".tgrandtotal").html(parseFloat(roundof).toFixed(2)); 
            $(".tgrandtotal_p").val(parseFloat(roundof).toFixed(2)); 
    }

</script>
@endpush
