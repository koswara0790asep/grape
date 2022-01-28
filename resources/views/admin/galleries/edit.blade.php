@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Tambah Product</h2>
                <hr>

                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Judul Karya</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Nama Karya" value="{{ $gallery->title }}">
                            @error('title')
                                <div class="mt-2 text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="price">Harga</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Harga Karya" value="{{ $gallery->price }}">
                            @error('price')
                                <div class="mt-2 text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="art_url">Karya</label>
                        <input type="file" name="art_url" id="art_url" class="form-control-file" placeholder="Nilai Karya" value="{{ $gallery->art_url }}">
                        @error('art_url')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea name="desc" id="desc" class="form-control" placeholder="Deskripsi Karya">{{ $gallery->desc }}</textarea>
                        @error('desc')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">SUBMIT <i class="fa fa-edit"></i></button>
                    <a href="/admin/galleries?admin_id={{ Auth::user()->id }}" class="btn btn-danger">CANCEL <i class="fa fa-close"></i></a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset("tinymce/js/tinymce/jquery.tinymce.min.js") }}"></script>
<script src="{{ asset("tinymce/js/tinymce/tinymce.min.js") }}"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });
</script>    
@endsection