<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{
    use HasFactory;

    protected $table = 'discount_rules';

    protected $fillable = [
        'category',
        'min_qty',
        'max_qty',
        'start_date',
        'end_date',
        'discount_type',
        'discount_value',
        'priority',
        'is_exclusive'
    ];
}
