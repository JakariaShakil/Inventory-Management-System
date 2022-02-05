<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use App\Exports\ProductsExport;
// use App\Imports\ProductsImport;
// use Maatwebsite\Excel\Facades\Excel;
use App\Unit;
use App\Brand;
use App\Product;
use App\Category;
use App\Supplier;
use File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Picqer;
use PDF;

class ProductController extends Controller
{
    
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = Product::latest()->with('category', 'supplier','unit','brand')->get();
        return view('backend.pages.product.view-product',$data);
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
        return view('backend.pages.product.add-product',compact(['categories','suppliers','units','brands']));
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
                      
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'category_id' => 'required',
            'brand_id' => 'required',
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
    ]);

    $data = new Product();
    $product_code = $request->product_code;
  
    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
    file_put_contents('Backend/img/product/barcode/' .$product_code. '.jpg', 
    $generator->getBarcode($product_code, $generator::TYPE_CODE_128, 3, 50));

    $data->product_name = $request->product_name;
    $data->product_code = $product_code;
    
    if($request->product_image)
    {
      $image = $request->file('product_image') ;
      $img = rand() . '.' .$image->getClientOriginalExtension();
      $location = public_path('Backend/img/product/' . $img);
      Image::make($image)->save($location);
      $data->product_image = $img;
    }

    // $data->quantity = $request->quantity;
    $data->category_id = $request->category_id;    
    $data->brand_id = $request->brand_id;
    $data->supplier_id = $request->supplier_id;
    $data->unit_id = $request->unit_id;
    $data->barcode = $product_code. '.jpg';
    $data->save();


    return redirect()->route('products.view')->with('message','Data Added Successfully');
 


       
        
        
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

        $products = Product::find($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        $units = Unit::all();
        $brands = Brand::all();

        return view('backend.pages.product.edit-product',compact(['products','categories','suppliers','units','brands']));
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
                      
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code',
            // 'quantity' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
    ]);
    
  

   
   

    $data = Product::find($id);
    $product_code = $request->product_code;

    if($request->product_code != '' && $request->product_code != $data->product_code ){
        if($data->barcode != ''){
            if(File::exists('Backend/img/product/barcode/' . $data->barcode)){
                File::delete('Backend/img/product/barcode/' . $data->barcode);

            }
            // $barcode_path = public_path() .'Backend/img/product/barcode/' .$data->barcode;
            // unlink($barcode_path);
            
        }
        
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents('Backend/img/product/barcode/' .$product_code. '.jpg', 
  $generator->getBarcode($product_code, $generator::TYPE_CODE_128, 3, 50));
        $data->barcode = $product_code. '.jpg'; 
    }
  
 
    
   
    if(!is_null($request->product_image))
    {
        if( File::exists('Backend/img/product/' . $data->product_image) ){
            File::delete('Backend/img/product/' . $data->product_image);
        }
      $image = $request->file('product_image') ;
      $img = rand() . '.' .$image->getClientOriginalExtension();
      $location = public_path('Backend/img/product/' . $img);
      Image::make($image)->save($location);
      $data->product_image = $img;
    }
    

    // $data->quantity = $request->quantity;
    $data->product_code = $product_code;
    $data->category_id = $request->category_id;
       
    $data->brand_id = $request->brand_id;
    $data->supplier_id = $request->supplier_id;
    $data->unit_id = $request->unit_id;
    $data->save();


    return redirect()->route('products.view')->with('info','Data updated Successfully');
 
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteProduct = Product::find($id);
        
        if(!is_null($deleteProduct ))
        {
            if( File::exists('Backend/img/product/' .$deleteProduct ->product_image) ){
                File::delete('Backend/img/product/' .$deleteProduct ->product_image);
            }
            if( File::exists('Backend/img/product/barcode/' .$deleteProduct ->barcode) ){
                File::delete('Backend/img/product/barcode/' .$deleteProduct ->barcode);
               
            }

            $deleteProduct ->delete();
        }
       
        return redirect()->route('products.view')->with('warning','Data deleted successfully');
    }



    // public function ImportProduct()
    // {
    //     return view('backend.pages.product.import-product');


    // }


    // public function export() 
    // {
    //     return Excel::download(new ProductsExport, 'products.xlsx');
    // }
           
    // public function import(Request $request) 
    // {
    //     $import=  Excel::import(new ProductsImport, $request->file('import_file'));
        
    //     if($import){
    //     return redirect()->route('products.view')->with('info','Data Imported Successfully');
    //      }
    //     else{
    //         return redirect()->back();
    //     }
        
    // }
    public function getProductsBarcode(){
        $products_info = Product::select('barcode','product_code')->paginate(12);
        return view('backend.pages.product.barcode.index',compact('products_info'));
    }


    

  
}
