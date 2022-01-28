<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $galleriesInstance = new Gallery();
        $galleries = $galleriesInstance->adminArts($request->get('admin_id'));

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|unique:galleries,title',
            'price' => 'required|numeric',
            'desc' => 'required',
            'art_url' => 'required|mimes:jpg,jpeg,svg,png',
        ]);
        
        $gallery = $request->all();
        $file = $request->file('art_url');
        $ext = $file->extension();
        $dateTime = date('Ymd_his');
        $newName = 'art_'.$dateTime.'.'.$ext;

        $newName = $file->storeAs("art_files", $newName);

        $gallery['user_id'] = Auth::user()->id;
        $gallery['art_url'] = $newName;
        Gallery::create($gallery);

        return redirect('/admin/galleries?admin_id='.Auth::user()->id)->with('success', 'Karya anda berhasil ditambahkan!');
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $this->validate(request(), [
            'title' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
            'art_url' => 'required|mimes:jpg,jpeg,svg,png',
        ]);

        if (request()->file('art_url')) {
            Storage::delete($gallery->image);
            $file = $request->file('art_url');

            $ext = $file->getClientOriginalExtension();
            $dateTime = date('Ymd_his');
            $newName = 'art_'.$dateTime.'.'.$ext;
    
            $newName = $file->storeAs("art_files", $newName);

        } else {
            $newName = $gallery->art_url;
        }

        $attr = $request->all();
        $attr['art_url'] = $newName;

        $gallery->update($attr);

        return redirect('/admin/galleries?admin_id='.Auth::user()->id)->with('success', 'Karya anda berhasil diubah!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->art_url);

        $gallery->delete();

        return redirect('admin/galleries')->with('success', 'Karya anda berhasil dihapus!');
    }
}
