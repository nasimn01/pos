@extends('layout.auth')

@section('content')
<!-- <h1 class="auth-title">Sign Up</h1> -->
@if(Session::has('response'))
    {!!Session::get('response')['message']!!}
@endif
<form action="{{route('register.store')}}" method="post">
    @csrf
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="step-1" role="tabpanel" aria-labelledby="step-1-tab">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex align-items-center">
                    <div class="d-flex justify-content-center side-img-reveal" id="auth-left">
                        <img src="{{ asset('/auth/img/pana.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-12 d-flex">
                    <div class="sideImage">
                        <div class="arrowUp">
                        <button type="button" class="prev-step d-none"><i class="bi bi-arrow-up-circle"></i></button>
                        </div>
                        <div class="drop">
                        <i class="bi bi-droplet-fill" style="color: #FFF;"></i>
                        <i class="bi bi-circle-fill"></i>
                        <i class="bi bi-circle-fill"></i>
                        </div>
                        <div class="arrowDown">
                        <button type="button" class="next-step"><i class="bi bi-arrow-down-circle"></i></button>
                        </div>
                        <img src="{{ asset('/auth/img/img1.png')}}" alt="">
                    </div>
                    <div class="card shadow left-border-radius">
                        <!-- Step 1 -->
                        <p class="auth-subtitle">step 1 out of 3</p>
                        <h1 class="auth-title mb-5">Personal Information</h1>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4 me-1">
                                    <input type="text" name="FullName" value="{{old('FullName')}}" class="form-control form-control-xl" placeholder="Full Name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    @if($errors->has('FullName'))
                                        <small class="d-block text-danger">
                                            {{$errors->first('FullName')}}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="email" name="EmailAddress" value="{{old('EmailAddress')}}" class="form-control form-control-xl" placeholder="Email">
                                    <div class="form-control-icon">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    @if($errors->has('EmailAddress'))
                                        <small class="d-block text-danger">
                                            {{$errors->first('EmailAddress')}}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" name="PhoneNumber" value="{{old('PhoneNumber')}}" class="form-control form-control-xl" placeholder="Phone Number">
                                    <div class="form-control-icon">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                    @if($errors->has('PhoneNumber'))
                                        <small class="d-block text-danger">
                                            {{$errors->first('PhoneNumber')}}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock-fill"></i>
                                    </div>
                                    @if($errors->has('password'))
                                        <small class="d-block text-danger">
                                            {{$errors->first('password')}}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="password" name="password_confirmation" class="form-control form-control-xl" placeholder="Retype Password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock-fill"></i>
                                    </div>
                                    @if($errors->has('password_confirmation'))
                                        <small class="d-block text-danger">
                                            {{$errors->first('password_confirmation')}}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary mt-5 next-step">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step-2" role="tabpanel" aria-labelledby="step-2-tab">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex align-items-center">
                    <div class="d-flex justify-content-center side-img-reveal" id="auth-left">
                    <img src="{{ asset('/auth/img/pana.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-12 d-flex">
                    <div class="sideImage">
                        <div class="arrowUp">
                        <button type="button" class="prev-step"><i class="bi bi-arrow-up-circle"></i></button>
                        </div>
                        <div class="drop">
                        <i class="bi bi-circle-fill"></i>
                        <i class="bi bi-droplet-fill" style="color: #FFF;"></i>
                        <i class="bi bi-circle-fill"></i>
                        </div>
                        <div class="arrowDown">
                        <button type="button" class="next-step"><i class="bi bi-arrow-down-circle"></i></button>
                        </div>
                        <img src="{{ asset('/auth/img/img1.png')}}" alt="">
                    </div>
                    <div class="card shadow left-border-radius">
                        <!-- Step 2 -->
                        <p class="auth-subtitle">step 2 out of 3</p>
                        <h1 class="auth-title mb-3">Business Information</h1>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <select class="form-control form-select" name="business_type">
                                        <option value="">Select Your Business type</option>
                                        @forelse (App\Models\Settings\Business_type::all();  as $d)
                                        <option value="{{$d->id}}" {{ old('business_type')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                        @empty
                                            <option value="">No Data Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" class="form-control form-control-xl" name="business_name" value="{{ old('business_name')}}" placeholder="Business Name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-briefcase-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" class="form-control form-control-xl" name="business_contact" value="{{ old('business_contact')}}" placeholder="Contact Number">
                                    <div class="form-control-icon">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" class="form-control form-control-xl" name="owner_name" value="{{ old('owner_name')}}" placeholder="Owner Name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pe-0">
                                <div class="form-group position-relative has-icon-left mb-4 me-1">
                                    <select onchange="show_division(this.value)" class="form-control form-select" name="country">
                                        <option value="">Select Country</option>
                                        @forelse (App\Models\Settings\Location\Country::all();  as $d)
                                            <option value="{{ $d->id }}" {{ old('country')==$d->id?"selected":""}}>{{ $d->name }}</option>
                                        @empty
                                            <option value="">No Data Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group position-relative has-icon-left mb-4 ms-1">
                                    <select onchange="show_district(this.value)" class="form-control form-select" name="state">
                                        <option value="">Select State</option>
                                        @forelse (App\Models\Settings\Location\Division::all();  as $d)
                                        <option class="div div{{$d->country_id}}" value="{{$d->id}}" {{ old('state')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                        @empty
                                            <option value="">No Data Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 pe-0">
                                <div class="form-group position-relative has-icon-left mb-4 me-1">
                                    <select class="form-control form-select" name="city" >
                                        <option value="">Select City</option>
                                        @forelse (App\Models\Settings\Location\District::all();  as $d)
                                        <option class="dist dist{{$d->division_id}}" value="{{$d->id}}" {{ old('city')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                        @empty
                                            <option value="">No Data Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group position-relative has-icon-left mb-4 ms-1">
                                    <input type="text" class="form-control form-control-xl" name="location" value="{{ old('location')}}" placeholder="Address">
                                    <div class="form-control-icon">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 d-flex">
                                <div class="small-view">
                                    <button type="button" class=" mt-3 me-2 prev-step"><span><i class="bi bi-arrow-left-circle-fill"></i></span></button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary mt-4 next-step">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
        <div class="tab-pane fade" id="step-3" role="tabpanel" aria-labelledby="step-3-tab">
            <div class="row m-1">
                <div class="col-12 p-0 d-flex justify-content-center">
                    <div class="sideImage">
                        <div class="arrowUp">
                            <button type="button" class="prev-step"><i class="bi bi-arrow-up-circle"></i></button>
                        </div>
                        <div class="drop">
                            <i class="bi bi-circle-fill"></i>
                            <i class="bi bi-circle-fill"></i>
                            <i class="bi bi-droplet-fill" style="color: #FFF;"></i>
                        </div>
                        <div class="arrowDown">
                            <button type="button" class="next-step"><i class="bi bi-arrow-down-circle"></i></button>
                        </div>
                        <img src="{{ asset('/auth/img/img1.png')}}" alt="">
                    </div>
                    <div class="card shadow left-border-radius flex-grow-1">
                        <!-- Step 3 -->
                        <p class="auth-subtitle">step 3 out of 3</p>
                        <h1 class="auth-title mb-5">Select your Package</h1>
                        <div class="row">
                            {{-- <div class="col-12 package-head d-flex justify-content-center">
                                <div><h4>Monthly</h4></div>
                                <div>
                                    <label class="switch">
                                        <input type="checkbox" name="monthly_or_yearly" value="{{old('monthly_or_yearly')}}">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div><h4>Yearly</h4></div>
                                <sub><span><b>(20% off)</b></span></sub>
                            </div>
                            <div class="purchase-currency my-2 text-end">
                                <label for="">Currency</label>
                                <select class="currency" name="currency" value="{{old('currency')}}">
                                    <option value="">canada</option>
                                    <option value="1">BDT</option>
                                </select>
                            </div> --}}

                            @forelse (App\Models\Settings\Package::where('status',1)->get();  as $d)
                            <div class="col-lg-4">
                                <div class="package mt-3">
                                    <div class="card shadow">
                                        <div class="card-head" style="background-color: {{$d->package_code}};"></div>
                                        <div class="package-title mt-4 d-flex justify-content-between">
                                            <h4>{{$d->package_name}}</h4>
                                            <input type="hidden" name="package" value="">
                                            <span class="checked d-none" id="checked-{{$d->id}}"><i class="bi bi-check-circle-fill"></i></span>
                                        </div>
                                        <div class="card-body">
                                            <div class="package-price">
                                                <h1><sup><i class="bi bi-coin"></i></sup>{{ number_format($d->price, 0) }}<sub><span>per</span> <br><span>month</span></sub></h1>
                                                <p class="my-4">You pay $22.88 --renews at $44.88/year</p>
                                            </div>
                                            <div class="package-features mb-3">
                                                @foreach(explode(',', $d->package_feature) as $feature)
                                                    <span><i class="bi bi-star-fill"></i><p>{{$feature}}</p></span>
                                                @endforeach
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary fw-bold fs-5 w-100" id="buy-btn-{{$d->id}}">Buy Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-4">
                                <div class="package mt-3">
                                    <div class="card shadow">
                                        <div class="card-header-one" style="background-color: #939ca4">
                                        </div>
                                        <h4 class="mt-4">Silver</h4>
                                        <div class="card-body">
                                            <div class="package-price">
                                                <h1><sup><i class="bi bi-coin"></i></sup>120<sub><span>per</span> <br><span>month</span></sub></h1>
                                                <p class="my-4">You pay $22.88 --renews at $44.88/year</p>
                                            </div>
                                            <div>
                                                <span><i class="bi bi-star-fill"></i><p class="active">7 Days trail</p></span>
                                                <span><i class="bi bi-star-fill"></i><p>Limited user</p></span>
                                                <span><i class="bi bi-star-fill"></i><p>Limited werehouse</p></span>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary mt-3">Buy Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                            <div class="col-12 d-flex">
                                <div class="small-view">
                                    <button type="button" class=" mt-3 me-2 prev-step"><span><i class="bi bi-arrow-left-circle-fill"></i></span></button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('button[id^="buy-btn-"]').click(function() {
            // Extract the package ID from the button's ID attribute
            var packageId = $(this).attr('id').split('-')[2];
            
            // Get the corresponding checked span and input field
            var checkedSpan = $('#checked-' + packageId);
            var inputField = $(this).closest('.package').find('input[name="package"]');
            
            if ($(this).hasClass('btn-selected')) {
                // If the button is already selected, deselect it
                checkedSpan.addClass('d-none');
                inputField.val('');
                $(this).removeClass('btn-danger').addClass('btn-secondary').removeClass('btn-selected').text('Buy Now');
            } else {
                // Deselect any previously selected buttons
                $('.btn-selected').removeClass('btn-danger').addClass('btn-secondary').removeClass('btn-selected').text('Buy Now');
                $('.checked').addClass('d-none');
                $('input[name="package"]').val('');
                
                // Select the clicked button
                checkedSpan.removeClass('d-none');
                inputField.val(packageId);
                $(this).removeClass('btn-secondary').addClass('btn-danger').addClass('btn-selected').text('Cancel');
            }
        });
    });
</script>
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

<script>
    function revealStep(element) {
      ScrollReveal({ 
        reset: true,
        distance: '60px',
        duration: 800,
        delay: 200
      }).reveal(element, { delay: 200, origin: 'left', interval: 30 });
    }
  
    // Get all the next-step buttons
    const nextStepButtons = document.querySelectorAll('.next-step');
  
    // Get all the prev-step buttons
    const prevStepButtons = document.querySelectorAll('.prev-step');
  
    // Add event listeners to the next-step buttons
    nextStepButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const currentStep = button.closest('.tab-pane');
        const nextStep = currentStep.nextElementSibling;
        revealStep(nextStep);
      });
    });
  
    // Add event listeners to the prev-step buttons
    prevStepButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const currentStep = button.closest('.tab-pane');
        const prevStep = currentStep.previousElementSibling;
        revealStep(prevStep);
      });
    });
  </script>
@endpush