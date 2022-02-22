<?php

namespace App\Http\Controllers\Backend;

use PDF;
use Image;
use App\Payment;
use App\Customer;
use App\InvoiceDetail;
use App\PaymentDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = Customer::all();
        return view('backend.pages.customer.view-customer',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.customer.add-customer');
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
           
            'name' => 'required',
            'mobile' => 'required|unique:customers,mobile',
            'address' => 'required',
            
                

    ]);
    $data = new Customer();
    $data->name = $request->name;
    $data->email = $request->email;
    $data->mobile = $request->mobile;    
    $data->address = $request->address;
    $data->created_by = Auth::user()->id;
    $data->save();


    return redirect()->route('customers.view')->with('message','Data Added Successfully');
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allCustomerData = Customer::find($id);

        return view('backend.pages.customer.edit-customer',compact('allCustomerData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
           
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            
                

    ]);

            $data = Customer::find($id);
            $data->name = $request->name;
        
            $data->mobile = $request->mobile;   
            $data->email = $request->email;  
            $data->address = $request->address;
            $data->save();


            return redirect()->route('customers.view')->with('info','Data Updated Successfully');
                
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteCustomer = Customer::find($id);

         $deleteCustomer ->delete();
        
       
        return redirect()->route('customers.view')->with('warning','Data deleted successfully');
    }
    //---- Customer Credit ----//
    public function customerCredit(){
        $customersCreditDetails = Payment::whereIn('paid_status', ['full_due','partial_paid'])->get();
        // dd($customersCredit->toArray());
        return view('backend.pages.customer.credit-customer', compact('customersCreditDetails'));
    }

    //---- Customer Credit PDF ----//
    public function customerCreditPdf(){
        $data['customersCredit'] = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        $pdf = PDF::loadView('backend.pages.pdf.customer-credit-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

      //---- Customer Credit Edit ----//
      public function customerCreditEdit($invoice_id){
        $data['payment'] = Payment::where('invoice_id', $invoice_id)->first();
        $data['invoice_details'] = InvoiceDetail::where('invoice_id', $invoice_id)->get();
          //dd($data->toArray());
       return view('backend.pages.customer.customer-credit-edit', $data);
    }
     //---- Customer Credit Update ----//
     public function customerCreditUpdate(Request $request, $invoice_id){
        //validation 
        //return $request;
       
         $this->validate($request,[
           
            'paid_status' => 'required',
             'date' => 'required'      

    ]);
         // partials paid validation
         if($request->new_paid_amount < $request->paid_amount) {
             return redirect()->back()->with('error','Error! Please Paid Exact Amount');
         } else{
             $payment = Payment::where('invoice_id', $invoice_id)->first();
             $paymentDetails = new PaymentDetail();
             $payment->paid_status = $request->paid_status;
             if($request->paid_status == 'full_paid') {
                 $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()->paid_amount + $request->new_paid_amount;
                 $payment->due_amount = '0';
                 $paymentDetails->current_paid_amount = $request->new_paid_amount;
             } elseif($request->paid_status == 'partial_paid'){
                 $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()->paid_amount + $request->paid_amount;
                 $payment->due_amount = $request->new_paid_amount - $request->paid_amount;
                 $paymentDetails->current_paid_amount = $request->paid_amount;
             }
             $payment->save();
             $paymentDetails->invoice_id = $invoice_id;
             $paymentDetails->date = date('Y-m-d', strtotime($request->date));
             $paymentDetails->updated_by = Auth::user()->id;
             $paymentDetails->save();
             // Redirect
              return redirect()->route('customers.credit')->with('message', 'Customer Credit Edit Successfully');
         }
     }
}
