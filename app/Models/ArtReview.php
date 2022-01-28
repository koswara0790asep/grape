<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gallery_id',
        'desc',
        'rating',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
