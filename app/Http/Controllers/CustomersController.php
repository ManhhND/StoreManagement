<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function getAllCustomer(){
        return Customer::orderBy('cid','DESC')->paginate(10);
    }

    public function editCustomer(Request $request){
        $this->validate($request,[
            'cname'=>'required',
            'caddress'=>'required' ,
            'cphone'=>'required' ,
            'cemail'=>'required'
        ]);
        $p = Customer::find($request->cid);
        $p->cname = $request->cname;
        $p->caddress = $request->caddress;
        $p->cphone = $request->cphone;
        $p->cemail = $request->cemail;
        $p->save();
    }

    public function editingCustomer($cid){
        $c = Customer::findOrFail($cid);
        return $c;
    }


    public function deleteCustomer($cid){
        $c = Customer::findOrFail($cid);
        $c->delete();
    }

    public function addCustomer(Request $request){
        $this->validate($request,[
            'cname'=>'required',
            'caddress'=>'required' ,
            'cphone'=>'required' ,
            'cemail'=>'required'
        ]);
        Customer::create([
            'cname'=>request('cname'),
            'caddress'=>request('caddress'),
            'cphone'=>request('cphone'),
            'cemail'=>request('cemail'),
        ]);
        $c = Customer::all();
        return $c;
    }
    public function getLastestCustomer(){
        return Customer::orderBy('cid','desc')->limit(1)->get();
    }
    public function searchCustomer(Request $request){
        $searchCustomer = $request->searchCustomer;
        $p = Customer::where('cname', 'like', '%'.$searchCustomer.'%')
            ->orwhere('cphone', 'like', '%'.$searchCustomer.'%')
            ->get();
        return $p;
    }
}
