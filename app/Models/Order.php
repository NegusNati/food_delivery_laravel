<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', 'status'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
