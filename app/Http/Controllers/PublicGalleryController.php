<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class PublicGalleryController extends Controller
{
    public function index(Request $request)
    {
        $galleryInstance = new Gallery();
        $galleries = $galleryInstance->orderArts($request->get('order_by'));
        
        return view('galleries.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        $reviews = $gallery->artReviews()->get();
        $star = $reviews->avg('rating');
        return view('galleries.show', [
            'gallery' => $gallery,
            'star' => $star,
            'reviews' => $reviews,
        ]);
    }
}
