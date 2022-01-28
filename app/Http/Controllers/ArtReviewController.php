<?php

namespace App\Http\Controllers;

use App\Models\ArtReview;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class ArtReviewController extends Controller
{

    public function store(Gallery $gallery)
    {
        $attribute = request()->all();
        $attribute['gallery_id'] = $gallery->id;
        $attribute['user_id'] = Auth::user()->id;

        ArtReview::create($attribute);

        return back()->with('success', 'Review have been saved');
    }
}
