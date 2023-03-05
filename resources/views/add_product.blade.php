@extends('layouts.master')

@section('title') Blog @endsection

@section('css')

    <!-- dropzone css -->
    <link href="{{ asset('assets/uploader/dist/image-uploader.min.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Product Add  @endslot
        @slot('title') Product Add View @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
        @include("layouts.flash_message")
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product </h4>
                    <p class="card-title-desc">Add Your Product </p>
                </div>
            {!! Form::open(['id'=>'product-add','method'=>'POST','action'=>['ProductController@save_product'],'enctype'=>'multipart/form-data']) !!}

                <div class="card-body p-4">
              
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                            
                                <div class="mb-3 col-6">
                                    <label for="example-text-input" class="form-label"> Product Title</label>
                                    <input class="form-control" type="text" name="title" placeholder="title" id="title">
                                    @if ($errors->has('title'))
                                                <span class="text-danger">
                                                    {{ $errors->first('title') }}
                                                </span>
                                   @endif
                                   <span  id="errortitle"></span>
                                </div>

                            </div>
                              <div class="col-lg-12">
                              <div class="mb-3 col-6 form-group">
                                      <label for="example-text-input" class="form-label"> Product Price</label>
                                      <input class="form-control" type="text" name="price" placeholder="PRICE" id="price">
                                      @if ($errors->has('price'))
                                                  <span class="text-danger">
                                                      {{ $errors->first('price') }}
                                                  </span>
                                    @endif
                                    <span  id="errorprice"></span>
                                  </div>
                                  <div class="mb-3 col-6 form-group">
                                      <label for="example-text-input" class="form-label"> Product Quantity </label>
                                      <input class="form-control" type="text" name="quantity" placeholder="Quantity" id="quantity">
                                      @if ($errors->has('quantity'))
                                                  <span class="text-danger">
                                                      {{ $errors->first('quantity') }}
                                                  </span>
                                    @endif
                                    <span  id="errorquantity"></span>
                                  </div>
                                <div>
                            <div >
                                <label class="form-label">Product images Upload</label>
                                <div class="input-images"></div>
                                @if ($errors->has('images'))
                                                <span class="text-danger">
                                                    {{ $errors->first('images') }}
                                                </span>
                                                @endif
                                                <span id="errorimage"></span>
                            </div>
                            </div>

                        <div> 
                    </div>
                                <div class="col-lg-12 ">
                                        <div class="mt-3">
                                            <a href="{{route('shop-home')}}" class="btn btn-light btn-pill">Cancel</a>
                                            <button type="submit" class="btn btn-primary btn-pill" >Upload</button>
                                        </div>
                                    </div>
                </div>
                {!! Form::close() !!}  
            </div>
        </div> <!-- end col -->
    </div>
@endsection

@section('script')
    <script>
            var product_add = function() {
    var form1 = $("#product-add");
    var errorHandler1 = $('.errorHandler', form1);
    var successHandler1 = $('.successHandler', form1);
    $(form1).validate({
        errorElement: "div", // contain the error msg in a span tag
        errorClass: 'invalid-feedback',
        errorPlacement: function(error, element) { // render error placement for each input type
            if (element.attr("name") == "title") { // for chosen elements, need to insert the error after the chosen container
                $("#errortitle").append(error);
            }else if (element.attr("name") == "images[]") {
                $("#errorimage").append(error);
            }else if(element.attr("name") == "price") {
                $("#errorprice").append(error);
            }else if(element.attr("name") == "quantity") {
                $("#errorquantity").append(error);
            }
        },
        ignore: "",
        rules: {
          title: {
              required: true,
            },
            price: {
                required: true,
                digits: true,
            },
            quantity: {
                required: true,
                digits: true,
            },
            "images[]": {
                required: true,
            }
        },
        messages: {
          "images[]": {
                required: "Image is Required!",
            },
            title: {
                required:"Title is Required!",
            },
            quantity: {
                required: "quantity is Required!",
                digits: "please enter digits only",
            },
            price: {
                required: "quantity is Required!",
                digits: "please enter digits only",
            }
        },
        invalidHandler: function(event, validator) { 
            successHandler1.hide();
            errorHandler1.show();
        },
        highlight: function(element) {
            $(element).closest('.form-control').removeClass('is-invalid');
            //display Checkbox invalid Data
            $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
            // display OK icon
            $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid').find('.symbol').removeClass('ok').addClass('required');
            // add the Bootstrap error class to the control group
        },
        unhighlight: function(element) { // revert the change done by hightlight
            //display Checkbox invalid Data

            $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');

            $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');

            // set error class to the control group
        },
        success: function(label, element) {
            //display Checkbox invalid Data

            $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');

            $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');
            // mark the current input as valid and display OK icon
        },
        submitHandler: function(form) {
            successHandler1.show();
            errorHandler1.hide();
            form.submit();
        }
    });
}
    $(document).ready(function() {
      product_add();
        $('.input-images').imageUploader();
});
        </script>
 <script src="{{asset('/assets/ajax.min.js')}}"></script>  
 <script src="{{asset('/assets/js/jquery-file.js')}}"></script>

 <script src="{{asset('assets/uploader/dist/image-uploader.min.js')}}"></script>
@endsection
