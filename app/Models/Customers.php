<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_name',
        'customer_type',
        'contact_number',
    ];
    use HasFactory;
}
