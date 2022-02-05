<?php

namespace App\Http\Controllers\Backend;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;

       $allCategory = Product::with('category')->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
   return response()->json($allCategory);
    }
}
