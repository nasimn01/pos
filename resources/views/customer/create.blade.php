@extends('layout.app')

@section('pageTitle',trans('Create customer'))
@section('pageSubTitle',trans('Create'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab active" href="{{route(currentUser().'.customer.create')}}">Add New</a>
                    <a class="card-tab " href="{{route(currentUser().'.customer.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.customer.store')}}">
                            @csrf
                            <div class="row">
                                {{-- @if( currentUser()=='owner')
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="branch_id">{{__('Branches Name')}}<span class="text-danger">*</span></label>
                                            <select class="form-control form-select" name="branch_id" id="branch_id">
                                                @forelse($branches as $b)
                                                    <option value="{{ $b->id }}" {{old('branch_id')==$b->id?'selected':''}}>{{ $b->name }}</option>
                                                @empty
                                                    <option value="">No branch found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" value="{{ branch()['branch_id']}}" name="branch_id">
                                @endif --}}

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="customerName">{{__('Customer Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="customerName" class="form-control" value="{{ old('customerName')}}" name="customerName" required>
                                        @if($errors->has('customerName'))
                                        <span class="text-danger"> {{ $errors->first('customerName') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="customerName">{{__('Company Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="customerName" class="form-control" value="{{ old('customerName')}}" name="customerName" required>
                                        @if($errors->has('customerName'))
                                        <span class="text-danger"> {{ $errors->first('customerName') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="contact">{{__('Contact')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="contact" class="form-control" value="{{ old('contact')}}" name="contact" required>
                                        @if($errors->has('contact'))
                                        <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="email">{{__('Email')}}</label>
                                        <input type="text" id="email" class="form-control" value="{{ old('email')}}" name="email">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="phone">{{__('Phone')}}</label>
                                        <input type="text" id="phone" class="form-control" value="{{ old('phone')}}" name="phone">
                                    </div>
                                    
                                </div>
                                {{-- <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="taxNumber">{{__('TAX Number')}}</label>
                                        <input type="text" id="taxNumber" class="form-control" value="{{ old('taxNumber')}}" name="taxNumber">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="gstNumber">{{__('GST Number')}}</label>
                                        <input type="text" id="gstNumber" class="form-control" value="{{ old('gstNumber')}}" name="gstNumber">
                                    </div>
                                </div> --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="openingAmount">{{__('Opening Balance')}}</label>
                                        <input type="text" id="openingAmount" class="form-control" value="{{ old('openingAmount')}}" name="openingAmount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="countryName">{{__('Country')}}</label>
                                        <select onchange="show_division(this.value)" class="form-control form-select" name="countryName" id="countryName">
                                            <option value="">Select Country</option>
                                            @forelse($countries as $d)
                                                <option  value="{{$d->id}}" {{ old('countryName')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No Category found</option>
                                            @endforelse
                                        </select>
                                        @if($errors->has('countryName'))
                                        <span class="text-danger"> {{ $errors->first('countryName') }}</span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="divisionName">{{__('State')}}</label>
                                        <select onchange="show_district(this.value)" class="form-control form-select" name="divisionName" id="divisionName">
                                            <option value="">Select State</option>
                                            @forelse($divisions as $d)
                                                <option  class="div div{{$d->country_id}}" value="{{$d->id}}" {{ old('divisionName')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No State found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="districtName">{{__('City')}}</label>
                                        <select class="form-control form-select" name="districtName" id="districtName">
                                            <option value="">Select City</option>
                                            @forelse($districts as $d)
                                                <option class="dist dist{{$d->division_id}}" value="{{$d->id}}" {{ old('districtName')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No City found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="postCode">{{__('Post Code')}}</label>
                                        <input type="text" id="postCode" class="form-control" value="{{ old('postCode')}}" name="postCode">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">{{__('Address')}}</label>
                                        <textarea class="form-control" name="address" id="address" rows="2">{{ old('address')}}</textarea>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
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
    /* call on load page */
    $(document).ready(function(){
        $('.div').hide();
        $('.dist').hide();
    })

    function show_division(e){
         $('.div').hide();
         $('.div'+e).show()
    }
    function show_district(e){
        $('.dist').hide();
        $('.dist'+e).show();
    }

    
   
    
</script>
@endpush