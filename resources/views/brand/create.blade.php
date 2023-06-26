@extends('layout.app')

@section('pageTitle',trans('Create Brand'))
@section('pageSubTitle',trans('Create'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab" href="{{route(currentUser().'.brand.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.brand.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.brand.store')}}">
                            @csrf
                            <div class="row">
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="brandName">{{__('Name')}}</label>
                                        <input type="text" id="brandName" class="form-control"
                                            placeholder="Brand Name" value="{{ old('brandName')}}" name="brandName">
                                    </div>
                                    @if($errors->has('brandName'))
                                    <span class="text-danger"> {{ $errors->first('brandName') }}</span>
                                    @endif
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