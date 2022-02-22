<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'supplier_id', 'unit_id', 'category_id', 'brand_id', 'product_name', 'product_code','barcode','product_image', 'quantity'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    public function invoiceDetail() {
        return $this->hasMany(InvoiceDetail::class);
    }
   
   
}
