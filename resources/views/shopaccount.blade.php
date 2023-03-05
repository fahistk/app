@extends('layouts.master')

<blade
    section|(%26%2339%3Btitle%26%2339%3B)%20%40lang(%26%2339%3Btranslation.Starter_Page%26%2339%3B)%20%40endsection%0D />
    <link href="{{ asset('assets/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />

@section('content')

@component('components.breadcrumb')
    @slot('li_1') shop now Pages @endslot
        @slot('title')  Shop @endslot
        @endcomponent

        <div class="row">
            @foreach($product as $pro)
                <div class="col-12 col-sm-4 col-md-3 ">
                    <div class="card" style="width: 18rem;">
                    <a href="{{route('product-view',['id'=> $pro['id']])}}" > 
                        <img src="{{ asset('product/'.$pro['images'][0]) }}"
                            class="card-img-top" alt="..." width="150" height="250"></a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $pro['title'] }}</h5>
                            <p class="card-text">${{number_format($pro['price'], 2) }}</p>
                            <button class="btn btn-primary" onclick="save_to_cart('{{$pro['id']}}', this);">Add to cart</button>
                        </div>
                    </div>
                </div>
            @endforeach
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
