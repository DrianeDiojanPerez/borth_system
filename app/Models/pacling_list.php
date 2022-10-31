<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacling_list extends Model
{
    use HasFactory;
    protected $fillable = ['bill_of_lading','voyage_number','container','agent','consignee','description',
    'quantity','package_type','reference_number','weight_unit','weight','dimentions_unit','height','width','length',
    'dock_receipt_number','shipping_marks','hoouse_BOL','empty'];
    
          
            
            
}
