<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\InvoiceDetail;
use App\Product;

class InvoicesController extends Controller{
    public function getAllInvoice(){
        return Invoice::with('customer','user')->orderBy('iid','desc')->get();
    }

    public function addInvoice(Request $request){
        $this->validate($request,[
            'uid'=>'required',
            'cid'=>'required' ,
        ]);
        Invoice::create([
            'uid'=>request('uid'),
            'cid'=>request('cid'),
        ]);
    }

    public function addInvoiceDetail(Request $request){
        $this->validate($request,[
            'iid' => 'required',
            'pid' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        InvoiceDetail::create([
            'iid'=>request('iid'),
            'pid'=>request('pid'),
            'quantity'=>request('quantity'),
            'price'=>request('price'),
        ]);
    }

    public function updateQtyDetail(Request $request){
        $this->validate($request,[
            'quantity'=>'required'
        ]);
        $product = Product::findOrFail($request->pid);
        $product->quantity = $request->quantity;
        $product->save();
    }

    public function getCurrentInvoiceID(){
        return Invoice::orderBy('iid','desc')->limit(1)->get();
    }
}