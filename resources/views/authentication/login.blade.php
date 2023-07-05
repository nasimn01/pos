@extends('layout.auth')

@section('content')
<form action="{{route('login.check')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6 align-items-center">
            <div class="d-flex justify-content-center side-img-reveal" id="auth-left">
                <img src="{{ asset('/auth/img/pana.png')}}" alt="">
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 col-sm-4 offset-sm-1 login-form-reveal">
            @if(Session::has('response'))
                {!!Session::get('response')['message']!!}
            @endif
            <div class="mt-5">
                <h1 class="login-title mb-4 text-uppercase">Login</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" name="PhoneNumber" value="{{old('PhoneNumber')}}" class="form-control form-control-xl" placeholder="Phone Number">
                            <div class="form-control-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="form-control-icon2 text-success">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>
                        @if($errors->has('PhoneNumber'))
                            <small class="d-block text-danger">
                                {{$errors->first('PhoneNumber')}}
                            </small>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="form-group position-relative has-icon-left mt-4 ">
                            <input type="password" name="password" id="pass_log_id" class="form-control form-control-xl" placeholder="Password">
                            
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                            <div class="form-control-icon2">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                            </div>
                        </div>
                        @if($errors->has('password'))
                            <small class="d-block text-danger">
                                {{$errors->first('password')}}
                            </small>
                        @endif
                        <a class="" href="#">Forgot Password?</a>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-dark mt-5 px-5 fw-bold">Log in</button>
                        <p class="mb-0 mt-3">You also can join with</p>
                        <div class="social">
                            <span><a href="#"><i class="bi bi-facebook"></i></a></span>
                            <span class=" mx-2"><a href="#"><i class="bi bi-google"></i></a></span>
                            <span ><a href="#"><i class="bi bi-twitter"></i></a></span>
                        </div>
                        <p>Don't have account? <a href="{{route('register')}}">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
    $(document).on('click', '.toggle-password', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        var input = $("#pass_log_id");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
</script>
<script>
    ScrollReveal({ 
      reset: true ,
      distance: '60px',
      duration: 800,
      delay: 200
    });
    ScrollReveal().reveal('.logo', { delay: 200, origin: 'top', interval: 30  });
    ScrollReveal().reveal('.side-img-reveal', { delay: 200, origin: 'left', interval: 30  });
    ScrollReveal().reveal('.login-form-reveal', { delay: 200,  origin: 'right', interval: 30 });
</script>
@endpush