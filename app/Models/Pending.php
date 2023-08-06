<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    protected $fillable = [
        'date_id',
        'customer',
        'employees_id',
        'services',
        'products',
        'quantity',
        'gcash',
        'gift_certificate',
        'gift_voucher',
        'loyalty'
    ];
    use HasFactory;
}
