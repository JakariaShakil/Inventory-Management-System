<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
Auth::routes();

Route::get('/', function() {
    return redirect('/login');

});

Route::group(['middleware' => ['auth']], function () { 
    


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'users', 'middleware'=>'isAdmin'], function () {
    Route::get('/view','Backend\UserController@view')->name('users.view');
    Route::get('/add','Backend\UserController@add')->name('users.add');
    Route::post('/store','Backend\UserController@store')->name('users.store');
    Route::get('/edit/{id}','Backend\UserController@edit')->name('users.edit');
    Route::post('/update/{id}','Backend\UserController@update')->name('users.update');
    Route::delete('/delete/{id}','Backend\UserController@delete')->name('users.delete');
    
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/view','Backend\ProfileController@viewProfile')->name('profile.view');
    Route::get('/edit/{id}','Backend\ProfileController@editProfile')->name('profile.edit');
    Route::post('/update/{id}','Backend\ProfileController@updateProfile')->name('profile.update');
    Route::get('/password/view','Backend\ProfileController@viewPassword')->name('profile.password.view');
    Route::post('/password/update','Backend\ProfileController@updatePassword')->name('profile.password.update');
    
   
    
});

Route::group(['prefix' => 'suppliers'], function () {
    Route::get('/view','Backend\SupplierController@view')->name('suppliers.view');
    Route::get('/add','Backend\SupplierController@add')->name('suppliers.add');
    Route::post('/store','Backend\SupplierController@store')->name('suppliers.store');
    Route::get('/edit/{id}','Backend\SupplierController@edit')->name('suppliers.edit');
    Route::post('/update/{id}','Backend\SupplierController@update')->name('suppliers.update');
    Route::delete('/delete/{id}','Backend\SupplierController@delete')->name('suppliers.delete');
    
});
Route::group(['prefix' => 'customers'], function () {
    Route::get('/view','Backend\CustomerController@view')->name('customers.view');
    Route::get('/add','Backend\CustomerController@add')->name('customers.add');
    Route::post('/store','Backend\CustomerController@store')->name('customers.store');
    Route::get('/edit/{id}','Backend\CustomerController@edit')->name('customers.edit');
    Route::post('/update/{id}','Backend\CustomerController@update')->name('customers.update');
    Route::delete('/delete/{id}','Backend\CustomerController@delete')->name('customers.delete');
    Route::get('/credit','Backend\CustomerController@customerCredit')->name('customers.credit');
    Route::get('/credit/pdf','Backend\CustomerController@customerCreditPdf')->name('customers.credit.pdf');
    Route::get('/credit/edit/{invoice_id}', 'Backend\CustomerController@customerCreditEdit')->name('customer.credit.edit');
    Route::post('/credit/update/{invoice_id}', 'Backend\CustomerController@customerCreditUpdate')->name('customer.credit.update');
});
Route::group(['prefix' => 'categories'], function () {
    Route::get('/view','Backend\CategoryController@view')->name('categories.view');
    Route::get('/add','Backend\CategoryController@add')->name('categories.add');
    Route::post('/store','Backend\CategoryController@store')->name('categories.store');
    Route::get('/edit/{id}','Backend\CategoryController@edit')->name('categories.edit');
    Route::post('/update/{id}','Backend\CategoryController@update')->name('categories.update');
    Route::delete('/delete/{id}','Backend\CategoryController@delete')->name('categories.delete');
});

Route::group(['prefix' => 'brands'], function () {
    Route::get('/view','Backend\BrandController@view')->name('brands.view');
    Route::get('/add','Backend\BrandController@add')->name('brands.add');
    Route::post('/store','Backend\BrandController@store')->name('brands.store');
    Route::get('/edit/{id}','Backend\BrandController@edit')->name('brands.edit');
    Route::post('/update/{id}','Backend\BrandController@update')->name('brands.update');
    Route::delete('/delete/{id}','Backend\BrandController@delete')->name('brands.delete');
});
Route::group(['prefix' => 'units'], function () {
    Route::get('/view','Backend\UnitController@view')->name('units.view');
    Route::get('/add','Backend\UnitController@add')->name('units.add');
    Route::post('/store','Backend\UnitController@store')->name('units.store');
    Route::get('/edit/{id}','Backend\UnitController@edit')->name('units.edit');
    Route::post('/update/{id}','Backend\UnitController@update')->name('units.update');
    Route::delete('/delete/{id}','Backend\UnitController@delete')->name('units.delete');
});

Route::group(['prefix' => 'employees','middleware'=>'isAdmin'], function () {
   //employee add,edit,delete
    Route::get('/view','Backend\EmployeeController@view')->name('employees.view');
    Route::get('/add','Backend\EmployeeController@add')->name('employees.add');
    Route::post('/store','Backend\EmployeeController@store')->name('employees.store');
    Route::get('/edit/{id}','Backend\EmployeeController@edit')->name('employees.edit');
    Route::post('/update/{id}','Backend\EmployeeController@update')->name('employees.update');
    Route::delete('/delete/{id}','Backend\EmployeeController@delete')->name('employees.delete');
    
    //Employee salary
    Route::get('/salary/view','Backend\EmployeeSalaryController@SalaryView')->name('employees.salary.view');
    Route::get('/salary/increment/{id}','Backend\EmployeeSalaryController@SalaryIncrement')->name('employees.salary.increment');
    Route::post('/salary/store/{id}','Backend\EmployeeSalaryController@SalaryStore')->name('update.increment.store');
    Route::get('salary/employee/details/{id}', 'Backend\EmployeeSalaryController@SalaryDetails')->name('employees.salary.details');

    Route::get('attendance/employee/view', 'Backend\EmployeeAttendanceController@AttendanceView')->name('employee.attendance.view');
    Route::get('attendance/employee/add',  'Backend\EmployeeAttendanceController@AttendanceAdd')->name('employee.attendance.add');
    Route::post('attendance/employee/store', 'Backend\EmployeeAttendanceController@AttendanceStore')->name('store.employee.attendance');
    Route::get('attendance/employee/edit/{date}',  'Backend\EmployeeAttendanceController@AttendanceEdit')->name('employee.attendance.edit');
    Route::post('attendance/employee/update', 'Backend\EmployeeAttendanceController@AttendanceUpdate')->name('update.employee.attendance');
    Route::get('attendance/employee/details/{date}', 'Backend\EmployeeAttendanceController@AttendanceDetails')->name('employee.attendance.details');


});

//products
Route::group(['prefix' => 'products'], function () {
    Route::get('/view','Backend\ProductController@view')->name('products.view');
    Route::get('/add','Backend\ProductController@add')->name('products.add');
    Route::post('/store','Backend\ProductController@store')->name('products.store');
    Route::get('/edit/{id}','Backend\ProductController@edit')->name('products.edit');
    Route::get('/show-product/{id}','Backend\ProductController@showProduct')->name('products.show.product');

    Route::post('/update/{id}','Backend\ProductController@update')->name('products.update');
    Route::delete('/delete/{id}','Backend\ProductController@delete')->name('products.delete');
    Route::get('/products/barcode','Backend\ProductController@getProductsBarcode')->name('products.barcode');
    Route::get('/report/barcode/pdf','Backend\ProductController@productBarcodeReportPdf')->name('product.barcode.report.pdf');
});

  //excel import and export
//   Route::get('/import-product','Backend\ProductController@ImportProduct')->name('import.product');
//   Route::get('/export','Backend\ProductController@export')->name('export');
//   Route::post('/import','Backend\ProductController@import')->name('import');

Route::group(['prefix' => 'purchase'], function () {
    Route::get('/view','Backend\PurchaseController@view')->name('purchase.view');
    Route::get('/add','Backend\PurchaseController@add')->name('purchase.add');
    Route::post('/store','Backend\PurchaseController@store')->name('purchase.store');
    Route::get('/pending','Backend\PurchaseController@pendingList')->name('purchase.pending.list');
    Route::post('/approve/{id}','Backend\PurchaseController@approve')->name('purchase.approve');
    Route::get('/report','Backend\PurchaseController@purchaseReport')->name('purchase.report');
    Route::get('/report/pdf','Backend\PurchaseController@purchaseReportPdf')->name('purchase.report.pdf');
   
    
    // Route::post('/update/{id}','Backend\PurchaseController@update')->name('purchase.update');
    Route::delete('/delete/{id}','Backend\PurchaseController@delete')->name('purchase.delete');
    Route::get('/edit/{id}','Backend\PurchaseController@edit')->name('purchase.edit');
});
//json request
Route::get('/get-category','Backend\PurchaseController@getCategory')->name('get-category');
Route::get('/get-brand','Backend\PurchaseController@getBrand')->name('get-brand');
Route::get('/get-product','Backend\PurchaseController@getProduct')->name('get-product');
// Route::get('/get/category/{id}','Backend\PurchaseController@getCategory');
// Route::get('/get/product/{id}','Backend\PurchaseController@getProduct');

Route::group(['prefix' => 'expenses'], function () {
    Route::get('/view','Backend\ExpenseController@view')->name('expenses.view');
    Route::get('/add','Backend\ExpenseController@add')->name('expenses.add');
    Route::post('/store','Backend\ExpenseController@store')->name('expenses.store');
    Route::get('/edit/{id}','Backend\ExpenseController@edit')->name('expenses.edit');
    Route::post('/update/{id}','Backend\ExpenseController@update')->name('expenses.update');
    Route::delete('/delete/{id}','Backend\ExpenseController@delete')->name('expenses.delete');
    Route::get('expense-today', 'Backend\ExpenseController@today_expense')->name('expenses.today');
Route::get('expense-month/{month?}', 'Backend\ExpenseController@month_expense')->name('expenses.month');
Route::get('expense-yearly/{year?}', 'Backend\ExpenseController@yearly_expense')->name('expenses.yearly');
});


Route::group(['prefix' => 'stock'], function () {
    Route::get('/report','Backend\stockController@stockReport')->name('stock.report');
    Route::get('/report/pdf','Backend\stockController@stockReportPdf')->name('stock.report.pdf');
    Route::get('/supplier/product/wise','Backend\stockController@supplierProductWise')->name('supplier.product.report');  
    Route::get('/report/supplier/wise/pdf','Backend\stockController@supplierProductWisePdf')->name('stock.supplier.report.pdf');
    Route::get('/report/product/wise/pdf', 'Backend\stockController@productWisePdf')->name('stock.product.wise.pdf');  

});


Route::group(['prefix' => 'invoice'], function(){
    Route::get('/view','Backend\InvoiceController@view')->name('invoice.view');
    Route::get('/add','Backend\InvoiceController@add')->name('invoice.add'); 
    Route::post('/store','Backend\InvoiceController@store')->name('invoice.store');
    Route::get('/pending','Backend\InvoiceController@pendingList')->name('invoice.pending.list');
    Route::get('/approve/{id}','Backend\InvoiceController@approve')->name('invoice.approve');
    Route::delete('/delete/{id}','Backend\InvoiceController@delete')->name('invoice.delete');
    Route::post('/approve/store/{id}','Backend\InvoiceController@approvalStore')->name('invoice.approval.store');
    Route::get('/print/list', 'Backend\InvoiceController@printList')->name('invoice.print.list');
    Route::get('/print/{id}', 'Backend\InvoiceController@print')->name('invoice.print');
    Route::get('/daily/report', 'Backend\InvoiceController@dailyReport')->name('invoice.daily.report');
    Route::get('/daily/report/pdf', 'Backend\InvoiceController@dailyReportPdf')->name('invoice.daily.report.pdf');



});
//json request
Route::get('/get-stock','Backend\InvoiceController@getStock')->name('check-product-stock');



});