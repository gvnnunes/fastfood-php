<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public    $timestamps   = true;
    protected $table        = 'orders';
    protected $fillable     = ['products', 'order_value_total', 'payment_value', 'payment_method' ,'change_value', 'customer_name', 'status'];
    protected $hidden       = ['remember_token'];
}
