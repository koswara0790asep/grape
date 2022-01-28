<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'desc',
        'user_id',
        'art_url',
    ];

    public function artReviews()
    {
        return $this->HasMany(ArtReview::class);
    }

    public function orderArts($order_by)
    {
        $query = 'SELECT * FROM galleries ORDER BY created_at DESC';

        if ($order_by == 'best_seller') {
            $query = "SELECT gls.*, orit.quantity FROM galleries AS gls LEFT JOIN (SELECT gallery_id, SUM(quantity) AS quantity FROM order_items GROUP BY gallery_id) AS orit ON orit.gallery_id = gls.id ORDER BY orit.quantity DESC";
        } elseif ($order_by == 'terbaik') {
            $query = 'SELECT g.*, art.rating FROM galleries AS g LEFT JOIN (SELECT gallery_id, AVG(rating) AS rating FROM art_reviews GROUP BY gallery_id) AS art ON art.gallery_id = g.id ORDER BY art.rating DESC';
        } elseif ($order_by == 'termurah') {
            $query = 'SELECT * FROM galleries ORDER BY price ASC';
        } elseif ($order_by == 'termahal') {
            $query = 'SELECT * FROM galleries ORDER BY price DESC';
        } elseif ($order_by == 'terbaru') {
            $query = 'SELECT * FROM galleries ORDER BY created_at DESC';
        }

        return DB::select($query);
    }

    public function adminArts($admin_id)
    {
        $query = 'SELECT * FROM galleries ORDER BY created_at ASC';

        if ($admin_id == Auth::user()->id) {
            $query = 'SELECT * FROM galleries WHERE user_id = "'.$admin_id.'" ORDER BY user_id ASC';
        }

        return DB::select($query);
    }
}
