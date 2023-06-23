@extends('layout.app')

@section('pageTitle',trans('Update Product'))
@section('pageSubTitle',trans('Update'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab " href="{{route(currentUser().'.product.create')}}">Add New</a>
                    <a class="card-tab" href="{{route(currentUser().'.product.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.product.update',encryptor('encrypt',$product->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$product->id)}}">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Category">{{__('Category')}}<span class="text-danger">*</span></label>
                                        <select onchange="show_subcat(this.value)" class="form-control form-select" name="category" id="category">
                                            <option value="">Select Category</option>
                                            @forelse($categories as $cat)
                                                <option value="{{$cat->id}}" {{ old('category',$product->category_id)==$cat->id?"selected":""}}> {{ $cat->category}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="subcategory">{{__('Sub Category')}}</label>
                                        <select onchange="show_childcat(this.value)" class="form-control form-select" name="subcategory" id="subcategory">
                                            <option value="">Select Sub Category</option>
                                            @forelse($subcategories as $sub)
                                                <option class="subcat subcat{{$sub->category_id}}" value="{{$sub->id}}" {{ old('subcategory',$product->subcategory_id)==$sub->id?"selected":""}}> {{ $sub->name}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="childcategory">{{__('Child Category')}}</label>
                                        <select class="form-control form-select" name="childcategory" id="childcategory">
                                            <option value="">Select Child Category</option>
                                            @forelse($childcategories as $child)
                                                <option class="childcat childcat{{$child->subcategory_id}}" value="{{$child->id}}" {{ old('childcategory',$product->childcategory_id)==$child->id?"selected":""}}> {{ $child->name}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="unit_id">{{__('Unit Style')}}</label>
                                        <select class="form-control form-select" name="unit_style" id="unit_style_select">
                                            <option value="">Select Unit</option>
                                            @forelse($unit_style as $u)
                                                <option value="{{$u->id}}" {{ old('unit_style',$product->unit_style_id)==$u->id?"selected":""}}> {{ $u->name}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse
                                            @if($errors->has('unit_style'))
                                            <span class="text-danger"> {{ $errors->first('unit_style') }}</span>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="brand_id">{{__('Brand')}}</label>
                                        <select class="form-control form-select" name="brand_id" id="brand_id">
                                            <option value="">Select Brand</option>
                                            @forelse($brands as $b)
                                                <option value="{{$b->id}}" {{ old('name',$product->brand_id)==$b->id?"selected":""}}> {{ $b->name}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="code">{{__('Item Code')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('itemCode',$product->item_code)}}" name="itemCode">
                                            @if($errors->has('itemCode'))
                                            <span class="text-danger"> {{ $errors->first('itemCode') }}</span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Product Name">{{__('Product Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="productName" class="form-control"
                                            placeholder="Product Name" value="{{ old('productName',$product->product_name)}}" name="productName">
                                            
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="image">{{__('Image')}}</label>
                                        <input type="file" id="image" class="form-control" name="image">
                                            
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">{{__('Description')}}</label>
                                        <textarea  class="form-control" id="description"
                                            placeholder="Product description" name="description">{{ old('description',$product->description)}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-borderd" id="child_units_table" class="table">
                                        <thead>
                                            <tr class="bg-primary text-white text-center">
                                                <th>Unit Name</th>
                                                <th>Price</th>
                                                <th>Barcode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($product->product_price as $pr)
                                            <tr class="text-center">
                                                <td><input type="hidden" name="product_price[]" value="{{$pr->unit_id}}">{{$pr->unit?->name}}</td>
                                                <td><input type="text" class="form-control" value="{{$pr->price}}" name="price[]"></td>
                                                <td><input type="text" class="form-control" value="{{$pr->barcode}}" name="barcode[]" onBlur="Availability(this)"></td>
                                            </tr>
                                            @empty
                                            <tr class="text-center">
                                                <td colspan="3">No Data Found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="col-12 d-flex justify-content-end">
                                <img width="80px" height="40px" class="float-first" src="{{asset('images/product/'.company()['company_id'].'/'.$product->image)}}" alt="">
                                    <button type="submit" class="btn btn-info me-1 mb-1">{{__('Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#unit_style_select').change(function() {
        var selectedUnitStyle = $(this).val();
        if (selectedUnitStyle !== '') {
            $.ajax({
                url: '{{route(currentUser().'.getChildUnits')}}',
                type: 'GET',
                data: {
                    unitStyleId: selectedUnitStyle
                },
                dataType: 'json',
                success: function(response) {
                    var childUnits = response.childUnits;
                    var tableBody = $('#child_units_table tbody');
                    tableBody.empty();
                    if (childUnits.length > 0) {
                        $.each(childUnits, function(index, childUnit) {
                            var row = '<tr class="text-center">' +
                                '<td><input type="hidden" name="product_price[]" value="' + childUnit.id + '">' + childUnit.name + '</td>' +
                                '<td><input type="text" class="form-control" name="price[]"></td>' +
                                '<td><input type="text" class="form-control" name="barcode[]" onBlur="Availability(this)"></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    } else {
                        var row = '<tr class="text-center"><td colspan="3">No data found</td></tr>';
                        tableBody.append(row);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error); // Handle the error if needed
                }
            });
        } else {
            $('#child_units_table tbody').empty();
        }
    });
});
</script>
<script>
    function Availability(inputField) {
        var barcode = inputField.value;
        var product_id = {{$product->id}}
        $.ajax({
            url: '{{route(currentUser().'.checkBarcodeAvailability')}}',
            type: 'GET',
            data: { barcode: barcode,
                    productId: product_id
                },
            dataType: 'json',
            success: function(response) {
                if (!response.available) {
                    alert('This Barcode is already used');
                    inputField.value = ""; // Clear the input field
                }
            },
            error: function(xhr, status, error) {
                console.log(error); // Handle the error if needed
            }
        });
    }
</script>
<script>
    /* call on load page */
    $(document).ready(function(){
        $('.subcat').hide();
        $('.childcat').hide();
    })

    function show_subcat(e){
         $('.subcat').hide();
         $('.subcat'+e).show()
    }
    function show_childcat(e){
        $('.childcat').hide();
        $('.childcat'+e).show();
    }

    
   
    
</script>
@endpush