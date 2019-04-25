<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller{
    public function getAllType(){
        return ProductType::all();
    }

    public function editType(Request $request){
        $this->validate($request,[
            'tname'=>'required',
            'tdescription'=>'required' ,
        ]);
        $p = ProductType::findOrFail($request->tid);
        $p->tname = $request->tname;
        $p->tdescription = $request->tdescription;
        $p->save();
    }

    public function editingType($tid){
        $p = ProductType::findOrFail($tid);
        return $p;
    }


    public function deleteType($tid){
        $product = ProductType::findOrFail($tid);
        $product->delete();
    }

    public function addType(Request $request){
        $this->validate($request,[
            'tname'=>'required',
            'tdescription'=>'required' ,
        ]);
        ProductType::create([
            'tname'=>request('tname'),
            'tdescription'=>request('tdescription'),
        ]);
        $p = ProductType::all();
        return $p;
    }
}