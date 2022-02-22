<?php

namespace App\Http\Controllers;

use App\Unit;
use App\User;
use App\Invoice;
use App\Product;
use App\Category;
use App\Customer;
use App\Employee;
use App\Purchase;
use App\Supplier;
use App\InvoiceDetail;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         // Earning Report========
         $date = date('Y-m-d');
         $todayTotalSell = InvoiceDetail::where('date', $date)->where('status', 1)->sum('selling_price');
         $todaySellQun = DB::table('invoice_details')
            ->join('products', 'products.id', '=', 'invoice_details.product_id')
            ->select('products.unit_buying_price', 'invoice_details.selling_quantity')
            ->where('invoice_details.date', $date)->where('invoice_details.status', 1)
            ->get();
            $todayBuyingPrice=0;
        if(count($todaySellQun)) {
            foreach($todaySellQun as $item) {
                $todayBuyingPrice += $item->unit_buying_price * $item->selling_quantity;
            }
        }
        
         $todayInvoiceCount = Invoice::where('status', 1)->whereDate('created_at', today())->count();
         $todayPurchase = Purchase::where('date', $date)->where('status', 1)->sum('buying_price');
         $todayPurchaseCount = Purchase::where('date', $date)->where('status', 1)->count();
         // Others===============
         $category = Category::all()->count();
         $supplier = Supplier::all()->count();
         $products = Product::all()->count();
         $users    = User::all()->count();
         $customer = Customer::all()->count();
         $unit     = Unit::all()->count();
         $employee     = Employee::all()->count();
         
         $totalPurchase = Purchase::all()->count();
         $totalInvoice = Invoice::all()->count();
         $pending_invoice = Invoice::where('status', 0)->get()->count();
         $due_amount = Payment::sum('due_amount');
 
         return view('backend.pages.dashboard.home', compact('todayTotalSell','employee','todayBuyingPrice', 'todayInvoiceCount', 'todayPurchase', 'todayPurchaseCount', 'category', 'supplier', 'products', 'users', 'customer', 'unit', 'totalPurchase', 'totalInvoice', 'pending_invoice', 'due_amount'));
        
    }
}
