<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function getAllProduct(){
        return Product::with('type','vendor')->orderBy('pid', 'DESC')->paginate(5);
    }

    public function editProduct(Request $request){
        $this->validate($request,[
            'pname'=>'required',
            'tid'=>'required' ,
            'price'=>'required' ,
            'quantity'=>'required',
            'vid' => 'required'
        ]);
        $p = Product::findOrFail($request->pid);
        $p->pname = $request->pname;
        $p->tid = $request->tid;
        $p->price = $request->price;
        $p->quantity = $request->quantity;
        $p->vid = $request->vid;
        $p->save();
    }

    public function editingProduct($pid){
        $p = Product::findOrFail($pid);
        return $p;
    }


    public function deleteProduct($pid){
        $product = Product::findOrFail($pid);
        $product->delete();
    }

    public function addProduct(Request $request){
        $this->validate($request,[
            'pname'=>'required',
            'tid'=>'required' ,
            'price'=>'required' ,
            'quantity'=>'required',
            'vid'=>'required'
        ]);
        Product::create([
            'pname'=>request('pname'),
            'tid'=>request('tid'),
            'price'=>request('price'),
            'quantity'=>request('quantity'),
            'vid'=>request('vid'),
            ]);
        $p = Product::all();
        return $p;
    }

    public function search(Request $request){
        $search = $request->search;
        return $p = DB::table('products')->where('pname', 'like', '%'.$search.'%')->get();
    }
}
