<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $fillable = ['payment_id','product_name','quantity',
    'amount','currency','customer_name','customer_email','payment_status','payment_method','created_at','updated_at'];
}
