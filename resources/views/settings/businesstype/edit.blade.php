@extends('layout.app')

@section('pageTitle','Update Business Type')
@section('pageSubTitle','Update')

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.business.update',encryptor('encrypt',$data->id))}}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{old('name',$data->name)}}" class="form-control" name="name" required>
                                    </div>
                                </div>
                                
                                <div class="col-8 offset-2 d-flex justify-content-end">
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