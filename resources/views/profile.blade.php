@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col md-12">
        <div class="row">
            <center>
                @if (Auth::user()->picture == NULL)
                <img src="{{ asset("user_img/default.png") }}" alt="...." style="width: 100px;box-shadow: 5px 5px 5px grey; border-radius: 100%;">
                @else
                <img src="{{ Auth::user()->picture }}" alt="...." style="width: 100px;box-shadow: 5px 5px 5px grey; border-radius: 100%;">
                @endif
                <h2>{{ Auth::user()->name }}</h2>
            </center>
        <hr>
        <div class="col-md-12">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>Nama Pengguna : </td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>E-mail : </td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td>Verifikasi : </td>
                        <td>{{ Auth::user()->email_verified_at }}</td>
                    </tr>
                    <tr>
                        <td>Registrasi Pada : </td>
                        <td>{{ Auth::user()->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection