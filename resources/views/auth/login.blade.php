@extends('layouts.master-without-nav')

@section('title')
    Login
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
                                            <h5 class="mb-0">Welcome Back !</h5>
                                          
                                        </div>
                                            @include("layouts.flash_message")

                                        {!! Form::open(['id'=>'login-user','method'=>'POST','action'=>['Auth\LoginController@login'],'enctype'=>'multipart/form-data']) !!}
                                            @csrf

                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input id="username" type="text"
                                                    class="form-control" name="username"
                                                    placeholder="Enter Username" >

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <span id="errorusername">
                                                    </span>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <label class="form-label">Password</label>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="input-group auth-pass-inputgroup">
                                                    <input id="password" type="password" placeholder="Enter Password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" 
                                                         autocomplete="current-password">


                                                   
                                                    <button class="btn btn-light ms-0" type="button" id="show_password"><i
                                                            class="mdi mdi-eye-outline"></i></button>

                                                </div>
                                                @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span id="errorpassword"> </span>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                                        <label class="form-check-label" for="remember-check">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit">Log In</button>
                                            </div>
                                            {!! Form::close() !!}    

                                        <div class="mt-4 pt-2 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                            </div>

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Don't have an account ? <a
                                                    href="{{ route('register') }}" class="text-primary fw-semibold">
                                                    Signup now </a> </p>
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
        <!-- password addon init -->
<script>
$(document).ready(function () {
    validateLoginForm();
});
var validateLoginForm = function () {
    var form1 = $("#login-user");
    var errorHandler1 = $('.errorHandler', form1);
    var successHandler1 = $('.successHandler', form1);
    $(form1).validate({
        errorElement: "div", // contain the error msg in a span tag
        errorClass: 'invalid-feedback',
        errorPlacement: function (error, element) { // render error placement for each input type
            if (element.attr("name") == "username") { // for chosen elements, need to insert the error after the chosen container
                $("#errorusername").append(error);
            }else if (element.attr("name") == "password") {
                $("#errorpassword").append(error);
            }

        },
        ignore: "",
        rules: {
            username: {
                required: true,
           
            },
            password: {
                required: true,
            },
        },

        messages: {
            username: {
                required: "Mobile No or Username required !",//$('#username_req_js').html(),
            },
            password: {
                required: "password required !",//$('#password_req_js').html(),
            },
        },
        invalidHandler: function (event, validator) { //display error alert on form submit
            successHandler1.hide();
            errorHandler1.show();
        },
        highlight: function (element) {
            $(element).closest('.form-control').removeClass('is-invalid');
            // display OK icon
            $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid').find('.symbol').removeClass('ok').addClass('required');
            // add the Bootstrap error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');

            // set error class to the control group
        },
        success: function (label, element) {
            $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');
            // mark the current input as valid and display OK icon
        },
        submitHandler: function (form) {
            successHandler1.show();
            errorHandler1.hide();
            form.submit();
        }
    });
}
const passBtncon = document.querySelector('#show_password');
passBtncon.addEventListener('click', () => {
    const passBtnconinput2 = document.querySelector('#password');
    passBtnconinput2.getAttribute('type') === 'password' ? passBtnconinput2.setAttribute('type', 'text') : passBtnconinput2.setAttribute('type', 'password');
}); 

 </script>
 <script src="{{asset('/assets/js/jquery-file.js')}}"></script>
 <script src="{{asset('assets/ajax.min.js')}}"></script>    
    @endsection