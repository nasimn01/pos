@extends('layout.app')
@section('pageTitle','Create Business Type')
@section('pageSubTitle','Create')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab active" href="{{route(currentUser().'.business.create')}}">Add New</a>
                    <a class="card-tab " href="{{route(currentUser().'.business.index')}}">List</a>
                </div>
                <div class="card-content mt-5">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.business.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{old('name')}}" class="form-control" name="name" required>
                                    </div>
                                </div>
                                
                                <div class="col-8 offset-2 d-flex justify-content-end">
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