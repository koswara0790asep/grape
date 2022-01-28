@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>List Arts Gallery</h2>
            <div>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-link text-light" style="background-color: #8C4660;">Tambah Karya</a>
                <a href="{{ route('galleries.index') }}" class="btn btn-light">Lihat Karya</a>
            </div>
            <br>
            <div class="form-group col-md-2">
                <label for="">User Admin: </label>
                <select name="admin_art" id="admin_art" class="form-control">
                    <option value="{{ Auth::user()->id }}" disabled selected>{{ Auth::user()->name }}</option>
                </select>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Create at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $gallery)
                        <tr>
                            <td>{{ $gallery->id }}</td>
                            <td>{{ $gallery->title }}</td>
                            <td>{{ $gallery->price }}</td>
                            <td>{{ $gallery->created_at }}</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.galleries.show', $gallery->id) }}" class="btn btn-sm btn-info">INFO <i class="fa fa-info"></i> </a>
                                <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="ml-2 btn btn-sm btn-secondary">EDIT <i class="fa fa-edit"></i> </a>
                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 btn btn-sm btn-danger">HAPUS <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#admin_art').change(function() {
                window.location.href = 'galleries/?admin_id=' + $(this).val();
            });
        });
    </script>
@endsection