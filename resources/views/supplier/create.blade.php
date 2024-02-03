@extends('layout.app')

@section('pageTitle',trans('Create Supplier'))
@section('pageSubTitle',trans('Create'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab active" href="{{route(currentUser().'.supplier.create')}}">Add New</a>
                    <a class="card-tab " href="{{route(currentUser().'.supplier.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.supplier.store')}}">
                            @csrf
                            <div class="row">
                                @if( currentUser()=='owner')
                                    <div class="col-lg-3 col-md-4 col-sm-12 d-none">
                                        <div class="form-group">
                                            <label for="branch_id">{{__('Branches Name')}}<span class="text-danger">*</span></label>
                                            <select class="form-control form-select" name="branch_id" id="branch_id">
                                                @forelse($branches as $b)
                                                    <option value="{{ $b->id }}" {{old('branch_id')==$b->id?"selected":""}}>{{ $b->name }}</option>
                                                @empty
                                                    <option value="">No branch found</option>
                                                @endforelse
                                            </select>
                                            @if($errors->has('branch_id'))
                                            <span class="text-danger"> {{ $errors->first('branch_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" value="{{ branch()['branch_id']}}" name="branch_id">
                                @endif

                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="supplierName">{{__('Supplier Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('supplierName')}}" name="supplierName" required>
                                        @if($errors->has('supplierName'))
                                        <span class="text-danger"> {{ $errors->first('supplierName') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="company">{{__('Company Name')}}</label>
                                        <input type="text" class="form-control" value="{{ old('companyName')}}" name="companyName">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="contact">{{__('Contact')}}<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" value="{{ old('contact')}}" name="contact" required>
                                        @if($errors->has('contact'))
                                        <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">{{__('Email')}}</label>
                                        <input type="email" class="form-control" value="{{ old('email')}}" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="phone">{{__('Phone')}}</label>
                                        <input type="number" class="form-control" value="{{ old('phone')}}" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="taxNumber">{{__('TAX Number')}}</label>
                                        <input type="number" class="form-control" value="{{ old('taxNumber')}}" name="taxNumber">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="fax">{{__('Fax')}}</label>
                                        <input type="number" class="form-control" value="{{ old('fax')}}" name="fax">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="openingAmount">{{__('Opening Balance')}}</label>
                                        <input type="number" class="form-control" value="{{ old('openingAmount')}}" name="openingAmount">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="openingAmount">{{__('Number Of Due Date')}}</label>
                                        <input type="number" class="form-control" value="{{ old('number_of_due_date')}}" name="number_of_due_date">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="countryName">{{__('Country')}}<span class="text-danger">*</span></label>
                                        <select onchange="show_division(this.value)" class="form-control form-select" name="countryName">
                                            <option value="">Select Country</option>
                                            @forelse($countries as $d)
                                                <option value="{{$d->id}}" {{ old('countryName')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No Country found</option>
                                            @endforelse
                                        </select>
                                        @if($errors->has('countryName'))
                                        <span class="text-danger"> {{ $errors->first('countryName') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="divisionName">{{__('State')}}</label>
                                        <select onchange="show_district(this.value)" class="form-control form-select">
                                            <option value="">Select State</option>
                                            @forelse($divisions as $d)
                                                <option class="div div{{$d->country_id}}" value="{{$d->id}}" {{ old('divisionName')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No division found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="districtName">{{__('City')}}</label>
                                        <select class="form-control form-select" name="districtName">
                                            <option value="">Select City</option>
                                            @forelse($districts as $d)
                                                <option class="dist dist{{$d->division_id}}" value="{{$d->id}}" {{ old('districtName')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No district found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="postCode">{{__('Post Code')}}</label>
                                        <input type="text" class="form-control" value="{{ old('postCode')}}" name="postCode">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">{{__('Address')}}</label>
                                        <textarea class="form-control" name="address" rows="2">{{ old('address')}}</textarea>
                                    </div>
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