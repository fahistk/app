<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use File;
use App\Http\Requests\ContactsRequest;
class ProductController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function add_product(){
        return view('add_product');
    }

    public function save_product(ContactsRequest $request){
         $Product = new Product();
         $i =0;
         $nameimage = array();
         if ($request->images) {

         foreach($request->images as $images){
            $documents = $images;
            $nameimage = 'product_.'.$i.'' . '_' . time() . '.' . $documents->extension();
            $documents->move(public_path() . '/product', $nameimage);
            $imagesarrayname[$i] = $nameimage;
            $i++;
         }
         $res = $Product->updatenewProduct($request,$imagesarrayname);
         if($res){
            return redirect()->route('product-add')->with('success','Updated successfully');
         }
        }
        return redirect()->route('product-add')->with('error', 'Error While Update');

    }
    public function product_view(Request $request, $id = ''){
        if($id){
            $Product = new Product();
            $this->product_one = $Product->getproductone($id);
            return view('product_view',$this->data);
        }
        return redirect()->route('shop-home');
    }

}
