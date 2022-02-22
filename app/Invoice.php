<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function payment(){
        return $this->belongsTo(Payment::class, 'id','invoice_id');
     }
     public function invoiceDetails(){
         return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
     }
}
