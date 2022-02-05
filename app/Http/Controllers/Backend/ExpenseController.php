<?php

namespace App\Http\Controllers\Backend;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $expenses = Expense::latest()->get();
        return view('backend.pages.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.expense.add');
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
           
            'name' => 'required | min:3',
            'amount' => 'required'
                

    ]);



        // $inputs = $request->except('_token');
        // $rules = [
        //   'name' => 'required | min:3',
        //   'amount' => 'required'
        // ];

        // $validator = Validator::make($inputs, $rules);
        // if ($validator->fails())
        // {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $date = Carbon::now();

        $expense = new Expense();
        $expense->name = $request->input('name');
        $expense->amount = $request->input('amount');
        $expense->month = $date->format('F');
        $expense->year = $date->format('Y');
        $expense->date = $date->format('Y-m-d');
        $expense->save();
        return redirect()->route('expenses.view')->with('message','Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('backend.pages.expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
           
            'name' => 'required | min:3',
            'amount' => 'required'
                

    ]);


     
        $expense = Expense::find($id);
        $expense->name = $request->input('name');
        $expense->amount = $request->input('amount');
        $expense->save();
        return redirect()->route('expenses.view')->with('info','Expense Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        return redirect()->route('expenses.view')->with('warning','Data deleted successfully');
    }


    public function today_expense()
    {
        // $today = date('Y-m-d');
        // $expenses = Expense::latest()->where('date', $today)->get();
        $expenses = Expense::whereDate('created_at',Carbon::now())->get();
        // $expenses = DB::table('expenses')->orderBy('date', 'DESC')->first();
        // dd($expenses);
       
        return view('backend.pages.expense.today', compact('expenses'));
    }

    public function month_expense($month = null)
    {
        if ($month == null)
        {
            $month = date('F');
        }
        $expenses = Expense::latest()->where('month', $month)->get();
        return view('backend.pages.expense.month', compact('expenses', 'month'));
    }

    public function yearly_expense($year = null)
    {
        if ($year == null)
        {
            $year = date('Y');
        }
        $expenses = Expense::latest()->where('year', $year)->get();
        $years = Expense::select('year')->distinct()->take(12)->get();
        return view('backend.pages.expense.year', compact('expenses', 'year', 'years'));
    }

}
