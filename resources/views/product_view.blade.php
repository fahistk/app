@extends('layouts.master')

@section('title') Blog @endsection

@section('css')
    <link href="{{ asset('assets/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Product Add  @endslot
        @slot('title') Product Add View @endslot
    @endcomponent
    


<div class="row">
  @foreach($product_one['images'] as $img)
  <div class="column col-4">
    <img src="{{ asset('product/'.$img) }}"  class="card-img-top" alt="..." width="150" height="250">
  </div>
  @endforeach
  <br>
  <br>
<ul>
  <ul>
  <li>Title : {{$product_one['title']}}</li>
  <li>Price : ${{number_format($product_one['price'], 2) }}</li>
  <br>
</ul>
<br>
<button class="btn btn-primary" onclick="save_to_cart('{{$product_one['id']}}', this);">Add to cart</button>
</div>
@endsection

@section('script')
<script>

function save_to_cart(id, element) {
    event.preventDefault();
    var id = id;
    $.ajax({
        url: "app/cart-store",
        data: {_token: $('meta[name="csrf-token"]').attr('content'),
            id: id
        },
        success: function (result) {
            if (result.status === 'yes') {
                $("#header").load(location.href + " #header");
                $.gritter.add({
                    title: "success",
                    text: "Added to cart successfully",
                    image: 'public/success.svg',
                    sticky: false,
                    time: '3000',
                    position: 'top',
                    class_name: 'bg-success',
                    fade_out_speed: 1000,
                });
            } else {
                $.gritter.add({
                    title: "error",
                    text: "error_in_carting",
                    image: 'public/error.svg',
                    sticky: false,
                    time: '3000',
                    position: 'top',
                    class_name: 'bg-danger',
                    fade_out_speed: 1000,
                });
            }

        }
    });
}
    </script>
    <script src="{{ asset('assets/gritter/js/jquery.gritter.js')}}"></script>
 <script src="{{asset('/assets/ajax.min.js')}}"></script>  
 <script src="{{asset('/assets/js/jquery-file.js')}}"></script>
@endsection
