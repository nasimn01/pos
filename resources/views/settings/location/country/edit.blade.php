@extends('layout.app')

@section('pageTitle',trans('Update Country'))
@section('pageSubTitle',trans('Update'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab" href="{{route(currentUser().'.country.create')}}">Add New</a>
                    <a class="card-tab " href="{{route(currentUser().'.country.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.country.update',encryptor('encrypt',$country->id))}}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$country->id)}}">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="countryName">{{__('Country Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="countryName" class="form-control" value="{{ old('countryName',$country->name)}}" name="countryName">
                                        @if($errors->has('countryName'))
                                            <span class="text-danger"> {{ $errors->first('countryName') }}</span>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="countryCode">{{__('Country Code')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="countryCode" class="form-control" value="{{ old('countryCode',$country->code)}}" name="countryCode">
                                        @if($errors->has('countryCode'))
                                            <span class="text-danger"> {{ $errors->first('countryCode') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="countryBn">{{__('Country Bangla')}}</label>
                                        <input type="text" id="countryBn" class="form-control" value="{{ old('countryBn',$country->name_bn)}}" name="countryBn">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-info me-1 mb-1">Update</button>
                                    
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
