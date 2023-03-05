@extends('layouts.master-without-nav')

@section('title')
    Register
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="index" class="d-block auth-logo">
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Register Account</h5>
                                        
                                        </div>

                                        @include("layouts.flash_message")

                                        {!! Form::open(['id'=>'register-user','method'=>'POST','action'=>['Auth\RegisterController@register_user'],'enctype'=>'multipart/form-data']) !!}

                                         
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input id="email" type="email"
                                                    class="form-control" name="email"
                                                    placeholder="Enter Username" >
                                                    @if ($errors->has('email'))
                                                <span class="text-danger">
                                                    {{ $errors->first('email') }}
                                                </span>
                                                @endif
                                                <span id="errorusername">
                                                    </span>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input id="username" type="text"
                                                    class="form-control" name="username"
                                                    placeholder="Enter Username" >

                                                @if ($errors->has('username'))
                                                <span class="text-danger">
                                                    {{ $errors->first('username') }}
                                                </span>
                                                @endif
                                                <span id="errorusername"> </span>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Phone No</label>
                                                <input id="mobile_no" type="text"
                                                    class="form-control" name="mobile_no"
                                                    placeholder="Enter Username" >

                                                    @if ($errors->has('mobile_no'))
                                                <span class="text-danger">
                                                    {{ $errors->first('mobile_no') }}
                                                </span>
                                                @endif
                                                <span id="errormobile_no"> </span>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                <input id="password" type="password"
                                                    class="form-control " name="password"
                                                    placeholder="Enter Username" >

                                                <button class="btn btn-light ms-0" type="button" id="show_password"><i
                                                            class="mdi mdi-eye-outline"></i></button></div>
                                         
                                                            @if ($errors->has('password'))
                                                <span class="text-danger">
                                                    {{ $errors->first('password') }}
                                                </span>
                                                @endif  
                                                <span id="errorpassword"> </span>
                                                        </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirmation Password</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                <input id="password_confirmation" type="password"
                                                    class="form-control " name="password_confirmation"
                                                    placeholder="Enter Username" >

                                                <button class="btn btn-light ms-0" type="button" id="show_password1"><i
                                                            class="mdi mdi-eye-outline"></i></button></div>
                                            
                                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger">
                                                    {{ $errors->first('password_confirmation') }}
                                                </span>
                                                @endif
                                                <span id="errorpassword_confirmation"> </span>
                                                        </div>
                                            
                                            <!-- <div class="mb-4">
                                                <p class="mb-0">By registering you agree to the Minia <a href="#"
                                                        class="text-primary">Terms of Use</a></p>
                                            </div> -->
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit">Register</button>
                                            </div>
                                            {!! Form::close() !!}

                                        <div class="mt-4 pt-2 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign up using -</h5>
                                            </div>

                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Already have an account ? <a
                                                    href=" @if (Route::has('login')){{ route('login') }} @endif" class="text-primary fw-semibold"> Login
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>



    @endsection

    @section('script')

        <!-- validation init -->
<script>
const PassBtn = document.querySelector('#show_password');
PassBtn.addEventListener('click', () => {
    const input = document.querySelector('#password');
    input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');

    if (input.getAttribute('type') === 'text') {
        PassBtn.innerHTML = '<i class="mdi mdi-eye-off"></i>';
    } else {
        PassBtn.innerHTML = '<i class="mdi mdi-eye-outline"></i>';
    }

});
const passBtncon = document.querySelector('#show_password1');
passBtncon.addEventListener('click', () => {
    const passBtnconinput = document.querySelector('#password_confirmation');
    passBtnconinput.getAttribute('type') === 'password' ? passBtnconinput.setAttribute('type', 'text') : passBtnconinput.setAttribute('type', 'password');

    if (passBtnconinput.getAttribute('type') === 'text') {
        passBtncon.innerHTML = '<i class="mdi mdi-eye-off"></i>';
    } else {
        passBtncon.innerHTML = '<i class="mdi mdi-eye-outline"></i>';
    }

});
</script>

 <script src="{{asset('/assets/js/jquery-file.js')}}"></script>
 <script src="{{asset('assets/ajax.min.js')}}"></script>   
 

    @endsection