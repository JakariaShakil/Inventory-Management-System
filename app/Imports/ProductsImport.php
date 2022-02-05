<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Product([
        'supplier_id'=>$row[0],
        'unit_id'=>$row[1],
        'category_id'=>$row[2],
        'brand_id'=>$row[3],
        'product_name'=>$row[4],
        'product_code'=>$row[5],
        'barcode'=>$row[6],
        'product_image'=>$row[7],
        'quantity'=>$row[8],
            //
        ]);
    }
}
