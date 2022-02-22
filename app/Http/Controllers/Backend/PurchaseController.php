<?php

namespace App\Http\Controllers\Backend;

use File;
use App\Unit;
use App\Brand;
use App\Product;
use App\Category;
use App\Purchase;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class PurchaseController extends Controller
{
    
    /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function view()
 {
     $data['allData'] = Purchase:: orderby('date','desc')->orderby('id','desc')->get();
     return view('backend.pages.purchase.view-purchase',$data);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function add()
 {
     $categories = Category::all();
     $suppliers = Supplier::all();
     $units = Unit::all();
     $brands = Brand::all();
     $products = Product::all();
     $purchases = Purchase::all();
     return view('backend.pages.purchase.add-purchase',compact(['categories','suppliers','units','brands','products','purchases']));
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
   
     $this->validate($request,[
                   
         'date' => 'required',
         'purchase_no' => 'required',
         'supplier_id' => 'required',
         'category_id' => 'required',
         'brand_id' => 'required',
         'product_id' => 'required',
        
 ]);
 
   if ($request->category_id==null)
   {
     return redirect()->back()->with('error','Sorry! you do not select any item');


   }
   else{
     $count_category = count($request->category_id);

      for( $i=0; $i<$count_category; $i++) {
      $purchase=new Purchase();
      
      $purchase->date = date('Y-m-d',strtotime($request->date[$i]));
    //   $purchase->date = $request->date[$i];
      $purchase->purchase_no = $request->purchase_no[$i];
      $purchase->supplier_id = $request->supplier_id[$i];
      $purchase->category_id = $request->category_id[$i];
      $purchase->brand_id = $request->brand_id[$i];
      $purchase->product_id = $request->product_id[$i];
      $purchase->buying_quantity = $request->buying_quantity[$i];
      $purchase->unit_price = $request->unit_price[$i];
      $purchase->unit_selling_price = $request->unit_selling_price[$i];
      $purchase->buying_price = $request->buying_price[$i];
      $purchase->description = $request->description[$i];
    //   $purchase->created_by = Auth::user()->id;
      $purchase->status = '0';

      

      $purchase->save();

      $product = Product::find($request->product_id[$i]);
      $product->unit_selling_price = $request->unit_selling_price[$i];
      $product->unit_buying_price = $request->unit_price[$i];
      $product->update();

      }
    }
 

 return redirect()->route('purchase.view')->with('message','Data Added Successfully');
   
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */

public function getCategory(Request $request){
    $supplier_id = $request->supplier_id;
    // dd($supplier_id);
   $allCategory = Product::with('category')->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
//    dd($allCategory->toArray());
return response()->json($allCategory);
}
 
public function getBrand(Request $request){
    $category_id = $request->category_id;
    //  dd($category_id);
    $allBrand = Product::with('brand')->select('brand_id')->where('category_id', $category_id)->groupBy('brand_id')->get();
//    dd($allProduct->toArray());
    return response()->json($allBrand);
}

public function getProduct(Request $request){
    $brand_id = $request->brand_id;
    $category_id = $request->category_id;

    $allProduct = Product::with('brand')->where('brand_id', $brand_id)->where('category_id',$category_id)->get();
//    dd($allProduct->toArray());
    return response()->json($allProduct);
}

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function delete($id)
 {
     $deletePurchase = Purchase::find($id);
    $deletePurchase ->delete();
    return redirect()->route('purchase.view')->with('warning','Data deleted successfully');
 }

 public function pendingList(){
    $data['allData'] = Purchase:: orderby('date','desc')->orderby('id','desc')->where('status','0')->get();
    return view('backend.pages.purchase.view-pending-list',$data);
 }
 public function approve($id){
    $purchase = Purchase::find($id);
    $product = Product::where('id',$purchase->product_id)->first();
    $purchase_quantity = ((float)($purchase->buying_quantity))+((float)($product->quantity));
    $product->quantity = $purchase_quantity;
    if($product->save()){
        DB::table('purchases')
        ->where('id', $id)
        ->update(['status' => 1]);
        
    }
    return redirect()->route('purchase.pending.list')->with('successs','Data approved successfully');

 }    
 public function purchaseReport(){
    return view('backend.pages.purchase.daily-purchase-report', compact('purchases'));
 }

 // purchase Report PDF //
 public function purchaseReportPdf(Request $request){
    // validation 
   $validation =  $request->validate([
       'start_date' => 'required',
       'end_date'   => 'required'
   ]);
   // Purchase report
   $start_date = date('Y-m-d', strtotime($request->start_date));
   $end_date   = date('Y-m-d', strtotime($request->end_date));
   $data['purchases'] = Purchase::whereBetween('date',[$start_date,$end_date])->orderBy('supplier_id')->orderBy('category_id')->where('status', '1')->get();
   $data['sdate'] = date('Y-m-d', strtotime($request->start_date));
   $data['edate']   = date('Y-m-d', strtotime($request->end_date));
   $pdf = PDF::loadView('backend.pages.pdf.daily-purchase-report-pdf', $data);
   $pdf->SetProtection(['copy', 'print'], '', 'pass');
   return $pdf->stream('document.pdf');
 }
}
