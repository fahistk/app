<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function cart_view(){
        $Product =new Product();
        $this->grand_total = \Cart::getTotal();
        $this->cart_data = $Product->getUserCart(\Cart::getContent());
        return view('cart_view',$this->data);
    }
    public function add(Request $request) {
        if (Auth::user()->id) {
            $cart_data = Product::find($request->id);
            $image = unserialize($cart_data->images);
            \Cart::add(array(
                'id' => $cart_data->id,
                'name' => $cart_data->title,
                'price' => $cart_data->price,
                'quantity' => 1,
                'image' => $image[0],
            ));
            return response()->json(['status' => 'yes']);
        } else {
            return redirect()->route('login');
        }
    }
    public function cart_update(Request $request) {

        $id = $request->id;
        $type = $request->type;
        if($type == '-'){
            $quty = $request->data - 1;
            \Cart::update(
                $request->id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $quty,
                    ],
                ]
            );
            $cartCollection = \Cart::getContent();
            $total = \Cart::getTotal();
            $i =0;
            foreach ($cartCollection as $val) {
                $data['id'] = $val->id;
                $data['quantity'] = $val->quantity;
                $data['price'] = $val->price;
                $data['subtotal'] = $val->price * $val->quantity;
                $data['total'] = \Cart::getTotal();
                $data['grand_total'] = \Cart::getTotal();
                $i++;
            }
            $data['status'] = 'yes';
    
            $cart_data = $data;
            return response()->json($cart_data);
        }else{
            $quty = $request->data + 1;
            \Cart::update(
                $request->id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $quty,
                    ],
                ]
            );
            $cartCollection = \Cart::getContent();
            $total = \Cart::getTotal();
            $i =0;
            foreach ($cartCollection as $val) {
                $data['id'] = $val->id;
                $data['quantity'] = $val->quantity;
                $data['price'] = $val->price;
                $data['subtotal'] = $val->price * $val->quantity;
                $data['total'] = \Cart::getTotal();
                $data['grand_total'] = \Cart::getTotal();
                $i++;
            }
            $data['status'] = 'yes';
    
            $cart_data = $data;
            return response()->json($cart_data);
        }

    }
    function remove_cart(Request $request, $id = '') {
        if ($id == '') {
            $id = $request->product_id;
            \Cart::remove($id);
            return response()->json(['status' => 'true']);
        } else {
            \Cart::remove($id);
            return redirect()->back()->with('success', 'Item Successfully Removed From Cart!');
        }
    }


}
