@extends('layout.app')
@section('pageTitle','Create Package')
@section('pageSubTitle','Create')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.package.store')}}">
                            @csrf
                            <div class="row row-container">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Package Name</label>
                                        <input type="text" value="{{old('package_name')}}" class="form-control" name="package_name" required>
                                    </div>
                                    {{-- @if($errors->has('name'))
                                        <span class="text-danger"> {{ $errors->first('name') }}</span>
                                    @endif --}}
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="day">Package Day</label>
                                        <input type="number" value="{{old('package_day')}}" class="form-control" name="package_day" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" value="{{old('price')}}" class="form-control" name="price" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="code">Package Code</label>
                                        <input type="text" value="{{old('package_code')}}" class="form-control" name="package_code">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="feature">Package Feature</label>
                                        <div class="input-wrapper">
                                            <input type="text" value="{{old('package_feature')}}" class="form-control position-relative" name="package_feature[]">
                                            <span class="addbtn text-primary package-feature-button" onclick="addField()"><i class="bi bi-plus-square-fill"></i></span>
                                            <span class="deletebtn text-danger package-feature-button" onclick="removeField(event)"><i class="bi bi-trash-fill"></i></span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
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
var fieldCounter = 1;

function addField() {
    var newFieldHtml = '<div class="col-lg-4 col-md-6 col-sm-12">' +
        '<div class="form-group">' +
        '<label for="feature">Package Feature</label>' +
        '<div class="input-wrapper">' +
        '<input type="text" value="{{old('package_feature')}}" class="form-control position-relative" name="package_feature[]" id="package_feature_' + fieldCounter + '">' +
        '<span class="deletebtn text-danger package-feature-button" onclick="removeField(event)"><i class="bi bi-trash-fill"></i></span>' +
        '</div>' +
        '</div>' +
        '</div>';

    fieldCounter++;

    $('.row-container').append(newFieldHtml);
}

function removeField(event) {
    $(event.target).closest('.col-lg-4').remove();
}
</script>
@endpush