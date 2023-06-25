@extends('layout.app')

@section('pageTitle',trans('Update Brand'))
@section('pageSubTitle',trans('Update'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab" href="{{route(currentUser().'.brand.create')}}">Add New</a>
                    <a class="card-tab " href="{{route(currentUser().'.brand.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.brand.update',encryptor('encrypt',$brand->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$brand->id)}}">
                            <div class="row">
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="brandName">{{__('Name')}}</label>
                                        <input type="text" id="brandName" class="form-control"
                                            placeholder="Brand Name" value="{{ old('brandName',$brand->name)}}" name="brandName">
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-start">
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