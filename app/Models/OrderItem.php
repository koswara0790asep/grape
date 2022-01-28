<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'gallery_id', 
        'price',
    ];

    public function review()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
