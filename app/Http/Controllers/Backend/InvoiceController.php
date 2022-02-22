<?php

namespace App\Http\Controllers\Backend;

use App\Backend\Purchase;
use App\Invoice;
use App\Payment;
use App\Category;
use App\Customer;
use App\InvoiceDetail;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Product;
use PDF;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
     //---- Invoice View ----//
     public function view(){
        $data['invoices'] = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status', '1')->get();
    	return view('backend.pages.invoice.view-invoice', $data);
    }
    //---- Invoice Add ----//
    public function add(){
    	$data['categories'] = Category::all();
    	$invoice_no = Invoice::orderBy('id','desc')->first();
    	if($invoice_no == null){
    		$firstInvoice = '0';
    		$data['invoiceData']  =  $firstInvoice+1;
    	} else{
    		$invoiceCheck = Invoice::orderBy('id','desc')->first()->invoice_no;
    		$data['invoiceData'] = $invoiceCheck+1;
    	}
        $data['customers'] = Customer::all();
        $data['date'] = date('Y-m-d');
        
     
    	return view('backend.pages.invoice.add-invoice', $data);
    }

     // Invoice Quantity show with Ajax //
     public function getStock(Request $request){
        $product = product::where('id', $request->product_id)->first();

        //$unit_selling_price = Purchase::where('product_id', $product_id)->first()->unit_selling_price;
        return response()->json(['stock' => $product->quantity, 'unit_selling_price' => $product->unit_selling_price]);
     }

    //---- Invoice Store With Multipal Table ----//
    public function store(Request $request){
        if($request->category_id == null) {
           return redirect()->back()->with('error', 'Sorry! You do not select any product');
        } else{
            if($request->estimated_ammount < $request->paid_amount) {
                return redirect()->back()->with('error', 'Sorry!  Paid Amount is maximum than total price');
            } else{
                  // Customer Data Insert Start //
                  if($request->customer_id == '0') {
                    $customer = new Customer();
                    $customer->name    = $request->name;
                    $customer->mobile  = $request->mobile;
                    $customer->address = $request->address;
                    $customer->save();
                    $customer_id = $customer->id;
                } else{
                    $customer_id = $request->customer_id;
                }
                // Customer Data Insert End //
              // Multipale Data Insert start //
                $invoice = new Invoice();
                $invoice->invoice_no  = $request->invoice_no;
                $invoice->date        = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status      = '0';
                $invoice->customer_id   =  $customer_id;
                $invoice->created_by  = Auth::user()->id;
                DB::transaction(function() use($request,$invoice,$customer_id) {
                   if($invoice->save()) {
                    // Invoice Details Insert Start //
                    $category_id = count($request->category_id);
                    for ($i=0; $i < $category_id; $i++) { 
                        $invoiceDetail = new InvoiceDetail();
                        $invoiceDetail->date          = date('Y-m-d', strtotime($request->date));
                        $invoiceDetail->invoice_id    = $invoice->id;
                        $invoiceDetail->category_id   = $request->category_id[$i];
                        $invoiceDetail->product_id    = $request->product_id[$i];
                        $invoiceDetail->selling_quantity   = $request->selling_quantity[$i];
                        $invoiceDetail->unit_price    = $request->unit_price[$i];
                        $invoiceDetail->selling_price = $request->selling_price[$i];
                        $invoiceDetail->status        = '1';
                        $invoiceDetail->save();
                    }
                    // Invoice Details Insert End //
                  
                    // Payment Data Insert Start //
                     $payment  = new Payment();
                     $paymentDetail = new PaymentDetail();
                     $payment->invoice_id      = $invoice->id;
                     $payment->customer_id     = $customer_id;
                     $payment->paid_status     = $request->paid_status;
                     $payment->total_amount    = $request->estimated_ammount;
                     $payment->discount_amount = $request->discount_amount;
                     if($request->paid_status == 'full_paid'){
                        $payment->paid_amount = $request->estimated_ammount;
                        $payment->due_amount  = '0';
                        $paymentDetail->current_paid_amount = $request->estimated_ammount;
                     } elseif($request->paid_status == 'full_due'){
                        $payment->paid_amount = '0';
                        $payment->due_amount  = $request->estimated_ammount;
                        $paymentDetail->current_paid_amount = '0';
                     } elseif($request->paid_status == 'partial_paid'){
                        $payment->paid_amount = $request->paid_amount;
                        $payment->due_amount  = $request->estimated_ammount - $request->paid_amount;
                        $paymentDetail->current_paid_amount = $request->paid_amount;
                     }
                     $payment->save();
                     $paymentDetail->invoice_id = $invoice->id;
                     $paymentDetail->date       = date('Y-m-d', strtotime($request->date));
                     $paymentDetail->save();
                    // Payment Data Insert End //
                   }
                });
              // Multipale Data Insert End //
            }
        }
        // Redirect //
        return redirect()->route('invoice.pending.list')->with('success', 'Invoice Added Successfully');
    }
    //---- Invoice Pending List ----//
    public function pendingList(){
        $invoicesPending = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.pages.invoice.pending-invoice-list', compact('invoicesPending'));
    }
    
    //---- Invoice Approvede ----//
    public function approve($id){
      $data['invoice'] = Invoice::with('invoiceDetails')->find($id);
      return view('backend.pages.invoice.invoice_approve', $data);
    }
    //---- Invoice Delete ----//
    public function delete($id){
        $invoiceDelete = Invoice::find($id);
        $invoiceDelete->delete();
        InvoiceDetail::where('invoice_id', $invoiceDelete->id)->delete();
        Payment::where('invoice_id', $invoiceDelete->id)->delete();
        PaymentDetail::where('invoice_id', $invoiceDelete->id)->delete();
        return redirect()->route('invoice.pending.list')->with('success', 'Invoice Deleted successfully');
      }
     //---- Invoice ApprovedProcess ----//
    public function approvalStore(Request $request, $id){
        
        foreach($request->selling_quantity as $key => $val){
           
            $invoiceDetail = InvoiceDetail::where('id', $key)->first();
           
           
            $product  = Product::where('id', $invoiceDetail->product_id)->first();

         
           
            if($product->quantity < $invoiceDetail->selling_quantity) {
                return redirect()->back()->with('warning', 'Sorry! Check your Product Stock');
            }
        }
        $invoice  = Invoice::find($id);
        $invoice->status = '1';
        $invoice->approved_by = Auth::user()->id;
        DB::transaction(function() use($request,$invoice,$id) {
           foreach($request->selling_quantity as $key => $val){
              $invoiceDetail = InvoiceDetail::where('id', $key)->first();
              $invoiceDetail->status = '1';
              $invoiceDetail->save();
              $product = Product::where('id', $invoiceDetail->product_id)->first();
              $product->quantity = ((float)$product->quantity)-((float)$invoiceDetail->selling_quantity);
              $product->save(); 
           }
           $invoice->save();
        });
        // Redirect 
        return redirect()->route('invoice.print.list')->with('success', 'Invoice approved successfullly');
       
    }
    // Invoice Print List //
    public function printList(){
        $data['invoices'] = Invoice::orderBy('date','desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('backend.pages.invoice.invoice-print-list', $data);
    }
    // Invoice Print //
    public function print($id) {
        $data['date'] = date('Y-m-d');
    $data['invoice'] = Invoice::with('invoiceDetails')->find($id);
    $pdf = PDF::loadView('backend.pages.pdf.invoice-print-report-pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('invoice.pdf');
   }
   // Invoice Daily //
   public function dailyReport(){
    return view('backend.pages.invoice.daily-invoice-report');
   }
   // Invoice Daily Print //
   public function dailyReportPdf(Request $request){
    // validation
   
    $this->validate($request,[
        'start_date' => 'required',
        'end_date'   => 'required'
            

]);
     $start_date = date('Y-m-d', strtotime($request->start_date));
     $end_date = date('Y-m-d', strtotime($request->end_date));
     $data['invoices'] = Invoice::whereBetween('date', [$start_date, $end_date])->where('status', '1')->get();
     $data['stime'] = date('Y-m-d', strtotime($request->start_date));
     $data['etime'] = date('Y-m-d', strtotime($request->end_date));
     $pdf = PDF::loadView('backend.pages.pdf.daily-invoice-report-pdf', $data);
     $pdf->SetProtection(['copy', 'print'], '', 'pass');
     return $pdf->stream('document.pdf');
   }
    
}
