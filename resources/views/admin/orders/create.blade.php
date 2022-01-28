@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>Menambahkan Alamat</h2>
            <br />

            @if (count($errors))
                <div class="form-group">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <br />

            
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email_address">Alamat E-mail Pembeli</label>
                    <input name="email_address" class="form-control" placeholder="E-mail Anda"></input>
                </div>
                <div class="form-group">
                    <label for="telp">Nomor Handphone</label>
                    <input name="telp" class="form-control" placeholder="Nomor Handphone"></input>
                </div>       
                <button type="submit" class="btn btn-success">Simpan <i class="fa fa-save"></i></button>
                <a href="/products" type="submit" class="btn btn-danger">Cancel <i class=" fa fa-close"></i></a>       
            </form>
        </div>
    </div>
</div>
@endsection