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
      $pdf = PDF::loadView('backend.pages.pdf.stock-report-pdf', $data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }
    // supplier/ product wais report //
    public function supplierProductWise(){
    	$data['suppliers'] = Supplier::all();
    	$data['categories'] = Category::all();
    	return view('backend.pages.stock.supplier-product-wise-report', $data);
    }
    // Supplier Wais PDF //
    public function supplierProductWisePdf(Request $request){
        
    	 $supplier_id = $request->supplier_id;

    	 $data['allData'] = Product::orderBy('category_id','asc')->orderBy('supplier_id','asc')->where('supplier_id', $supplier_id)->get();
    	 $pdf = PDF::loadView('backend.pages.pdf.supplier-wise-pdf-report', $data);
         $pdf->SetProtection(['copy', 'print'], '', 'pass');
         return $pdf->stream('document.pdf');
    	}
    
}


