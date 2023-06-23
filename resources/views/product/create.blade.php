@extends('layout.app')

@section('pageTitle',trans('Create Product'))
@section('pageSubTitle',trans('Create'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab active" href="{{route(currentUser().'.product.create')}}">Add New</a>
                    <a class="card-tab" href="{{route(currentUser().'.product.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.product.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Category">{{__('Category')}}<span class="text-danger">*</span></label>
                                        <select onchange="show_subcat(this.value)" class="form-control form-select" name="category" id="category">
                                            <option value="">Select Category</option>
                                            @forelse($categories as $cat)
                                                <option value="{{$cat->id}}" {{ old('category')==$cat->id?"selected":""}}> {{ $cat->category}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse
                                            
                                        </select>
                                        @if($errors->has('category'))
                                        <span class="text-danger"> {{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="subcategory">{{__('Sub Category')}}</label>
                                        <select onchange="show_childcat(this.value)" class="form-control form-select" name="subcategory" id="subcategory">
                                            <option value="">Select Sub Category</option>
                                            @forelse($subcategories as $sub)
                                                <option class="subcat subcat{{$sub->category_id}}" value="{{$sub->id}}" {{ old('subcategory')==$sub->id?"selected":""}}> {{ $sub->name}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="childcategory Name">{{__('Child Category')}}</label>
                                        <select class="form-control form-select" name="childcategory" id="childcategory">
                                            <option value="">Select Child Category</option>
                                            @forelse($childcategories as $child)
                                                <option class="childcat childcat{{$child->subcategory_id}}" value="{{$child->id}}" {{ old('childcategory')==$child->id?"selected":""}}> {{ $child->name}}</option>
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
                                                <option value="{{$u->id}}" {{ old('unit_style')==$u->id?"selected":""}}> {{ $u->name}}</option>
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
                                        <select class="form-control" name="brand_id" id="brand_id">
                                            <option value="">Select Brand</option>
                                            @forelse($brands as $b)
                                                <option value="{{$b->id}}" {{ old('name')==$b->id?"selected":""}}> {{ $b->name}}</option>
                                            @empty
                                                <option value="">No Data Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="code">{{__('Item Code')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('itemCode')}}" name="itemCode">
                                            @if($errors->has('itemCode'))
                                            <span class="text-danger"> {{ $errors->first('itemCode') }}</span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Product Name">{{__('Product Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="productName" class="form-control"
                                            placeholder="Product Name" value="{{ old('productName')}}" name="productName">
                                            @if($errors->has('productName'))
                                            <span class="text-danger"> {{ $errors->first('productName') }}</span>
                                            @endif
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="image">{{__('Image')}}</label>
                                        <input type="file" id="image" class="form-control" name="image">
                                            @if($errors->has('image'))
                                                <span class="text-danger"> {{ $errors->first('image') }}</span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">{{__('Description')}}</label>
                                        <textarea  class="form-control" id="description"
                                            placeholder="Product description" name="description">{{ old('description')}}</textarea>
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
                                            <!-- Child units will be dynamically added here -->
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">{{__('Save')}}</button>
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
                                '<td><input type="text" class="form-control" name="barcode[]" onBlur="Availability(this)" required></td>' +
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
        $.ajax({
            url: '{{route(currentUser().'.checkBarcodeAvailability')}}',
            type: 'GET',
            data: { barcode: barcode },
            dataType: 'json',
            success: function(response) {
                if (!response.available) {
                    alert('This Barcode is already used');
                    inputField.value = ""; // Clear the input field
                    var priceInput = inputField.closest('tr').querySelector('input[name="price[]"]');
                    priceInput.value = ""; // Clear the price input field
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