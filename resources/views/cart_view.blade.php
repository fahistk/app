@extends('layouts.master')

@section('title') Blog @endsection

@section('css')

    <!-- dropzone css -->
    <link href="{{ asset('assets/uploader/dist/image-uploader.min.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1')  Cart  @endslot
        @slot('title') Cart  View @endslot
    @endcomponent
    <div class="card mb-3">
    @include("layouts.flash_message")
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-table  border-right-sm" id="check_out">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="row-1">
                                <th class="row-title">
                                    <p>item</p>
                                </th>
                                <th class="row-title">
                                    <p>product name</p>
                                </th>
                                <th class="row-title">
                                    <p>price</p>
                                </th>
                                <th class="row-title">
                                    <p>quantity</p>
                                </th>
                                <th class="row-title">
                                    <p>subtotal</p>
                                </th>
                                <th class="row-title">
                                    <p></p>
                                </th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($cart_data as $value)
                            <tr class="row-2">
                                <td class="row-img"><img src="{{asset('product/'.$value['image'])}}" alt="cart-img" width="100" height="80"></td>
                                <td class="product-name" data-title="{{__('cart.product_name')}}"><a href="#">{{$value['name']}}</a></td>
                                <td class="product-price" data-title="{{__('cart.price')}}">
                                    <p>${{number_format($value['price'],2)}}</p>
                                </td>
                                <td class="product-quantity" data-title="{{__('cart.quantity')}}">
                                    <div class="quantity_filter">
                                        <input type="button" value="-" class="minus" onclick="quantity_decrement('quantity_{{$value['id']}}','{{$value['id']}}')">
                                        <input class="quantity-number qty" type="text" value="{{$value['quantity']}}" min="1" max="10" id="quantity_{{$value['id']}}">
                                        <input type="button" value="+" class="plus" onclick="quantity_increment('quantity_{{$value['id']}}','{{$value['id']}}')">
                                    </div>
                                </td>
                                <td class="product-total" data-title="{{__('cart.subprice')}}">
                                    <p id="total_price_{{$value['id']}}">${{number_format($value['quantity'] * $value['price'],2)}}</p>
                                </td>
                                <td class="row-close close-2" data-title="{{__('cart.productremove')}}"> <a href="{{route('remove-cart',['id'=> $value['id']])}}" data-toggle="tooltip" data-title="Remove">&times;</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12">
                                    <ul class="table-btn">
                                        <li><a href="{{route('shop-home')}}" class="btn btn-lg btn-circle btn-inverse"><i class="fa fa-chevron-left"></i>Continue shopping'</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-lg-4 col-md-6 col-sm-12">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="cart-inner-box box-2 text-center">
                    <div class="ci-title">
                        <h6>Total</h6>
                    </div>
                    <div class="ci-caption">
                        <ul>
                            <li><b>Total<span id="grand_total"> ${{number_format($grand_total,2)}}</span></b></li>
                        </ul>
                    </div>

                    <div class="ci-btn">
                        <a href="#" class="btn btn-lg btn-primary btn-block">checkout</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function quantity_decrement(quantity, id) {

    var val = $('#' + quantity).val();
    var type = '-';
    $.ajax({
        url: "app/cart-update",
        data: {
            id: id,
            data: val,
            type: type
        },
        success: function (response) {
            console.log(response);
            var quantity = response.quantity;

            if (quantity == 0)
            {
                $.ajax({
                    url: "remove-cart",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        product_id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'true') {
                            $("#check_out").load(location.href + " #check_out");
                            $("#header").load(location.href + " #header");
                        }
                    }
                });
            } else {
                var subtotal = response.subtotal;
                var total = response.total;
                var grand_total = response.grand_total;
                $("#quantity_" + id).val(quantity);
                $("#total_price_" + id).html('$'+subtotal.toFixed(2));
            $("#total").html('$'+total.toFixed(2));
            $("#grand_total").html('$'+grand_total.toFixed(2));
            }


        },

    });
}
function quantity_increment(quantity, id) {
    var val = $('#' + quantity).val();
    var delivery_charge = $('#delivery_charge').html();
    var shipping_charge = $('#shipping_charge').html();
    var tax = $('#tax').html();
    var type = '+';
    $.ajax({
        url: "app/cart-update",
        data: {
            id: id,
            data: val,
            type: type
        },
        success: function (response) {
            var quantity = response.quantity;
            var subtotal = response.subtotal;
            var total = response.total;
            var grand_total = response.grand_total;
            $("#quantity_" + id).val(quantity);
            $("#total_price_" + id).html('$'+subtotal.toFixed(2));
            $("#total").html('$'+total.toFixed(2));
            $("#grand_total").html('$'+grand_total.toFixed(2));
        },

    });
}
    </script>
 <script src="{{asset('/assets/ajax.min.js')}}"></script>  
 <script src="{{asset('/assets/js/jquery-file.js')}}"></script>

@endsection
