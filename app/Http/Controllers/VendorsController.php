<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller{
    public function getAllVendor(){
        return Vendor::all();
    }

    public function editVendor(Request $request){
        $this->validate($request,[
            'vname'=>'required',
            'vaddress'=>'required' ,
            'vphone'=>'required' ,
        ]);
        $p = Vendor::findOrFail($request->vid);
        $p->vname = $request->vname;
        $p->vaddress = $request->vaddress;
        $p->vphone = $request->vphone;
        $p->save();
    }

    public function editingVendor($vid){
        $c = Vendor::findOrFail($vid);
        return $c;
    }


    public function deleteVendor($vid){
        $c = Vendor::findOrFail($vid);
        $c->delete();
    }

    public function addVendor(Request $request){
        $this->validate($request,[
            'vname'=>'required',
            'vaddress'=>'required' ,
            'vphone'=>'required' ,
        ]);
        Vendor::create([
            'vname'=>request('vname'),
            'vaddress'=>request('vaddress'),
            'vphone'=>request('vphone'),
        ]);
        $c = Vendor::all();
        return $c;
    }
}