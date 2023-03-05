<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';  
    public function updatenewProduct($data,$imagearray){

        $Product = new Product();
        $Product->title = $data->title;
        $Product->price = $data->price;
        $Product->quantity = $data->quantity;
        $Product->images = serialize($imagearray);
        $Product->save();
        if($Product->id){
            return true;
        }
        return false;
    }

    public function getproduct($id=''){
        $product = Product::all();
        $data = array();
        $i=0;
        foreach($product as $pro){
            $data[$i]['id']  = $pro->id;
                $data[$i]['title']  = $pro->title;
                $data[$i]['price']  = $pro->price;
                $data[$i]['quantity']  = $pro->quantity;
                $data[$i]['images']  = unserialize($pro->images);
                $i++;
        }
        return $data;

    }
    function getUserCart($cart_arr) {
        $cartBag = array();
        $i = 0;
        foreach ($cart_arr as $ca) {
            $cartBag[$i]['id'] = $ca['id'];
            $cartBag[$i]['name'] = $ca['name'];
            $cartBag[$i]['price'] = $ca['price'];
            $cartBag[$i]['quantity'] = $ca['quantity'];
            $cartBag[$i]['priceSum'] = \Cart::get($ca['id'])->getPriceSum();
            $image = unserialize(Product::where('id', $ca['id'])->value('images'));
            $cartBag[$i]['image'] = ($image[0] != '') ? $image[0] : 'no-image.jpg';
            $i++;
        }
        return $cartBag;
    }
    public function getproductone($id){
        $pro = Product::find($id);
        $data = array();

            $data['id']  = $pro->id;
                $data['title']  = $pro->title;
                $data['price']  = $pro->price;
                $data['quantity']  = $pro->quantity;
                $data['images']  = unserialize($pro->images);
                return $data;
    }
}
