<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Supplier;
use PDF;

class StockController extends Controller
{
    public function stockReport(){
    	$products = Product::all();
    	return view('backend.pages.stock.stockReport', compact('products'));
    }
    // Stock Report PDF //
    public function stockReportPdf(){
      $data['stocks'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
      $pdf = PDF::loadView('backend.pages.pdf.stockReport', $data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }
    // supplier/ product wais report //
    public function supplierProductWise(){
    	$data['suppliers'] = Supplier::all();
    	$data['categories'] = Category::all();
    	return view('backend.pages.stock.supplierProductWiseReport', $data);
    }
    // Supplier Wais PDF //
    public function supplierProductWisePdf(Request $request){
    	// $supplier_id = $request->supplier_id;
    	// // dd($supplier_id);
    	// $data['suppliers'] = Product::orderBy('category_id','asc')->orderBy('supplier_id','asc')->where('supplier_id', $supplier_id)->get();
    	// $pdf = PDF::loadView('backend.pages.pdf.supplierWisePdfReport', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        // return $pdf->stream('document.pdf');
    	}
    // Product Wais PDF //
    public function productWisePdf(Request $request){
        // $category_id = $request->category_id;
        // $product_id = $request->product_id;
        // // validation 
        // $valiadation  = $request->validate([
        //     'category_id' => 'required',
        //     'product_id'  =>  'required'
        // ]);
        // // product wais report 
        // $data['product'] = Product::where('category_id', $category_id)->where('id',$product_id)->first();
        // $pdf = PDF::loadView('backend.pages.pdf.productWisePdfReport', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        // return $pdf->stream('document.pdf');
    }
}


