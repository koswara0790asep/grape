@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>List Galleries</h2>
            <div>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">Tambah Karya</a>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table-striped table-ms">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Harga Total</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 35%;">Alamat E-mail Pembeli</th>
                            <th style="width: 30%;">No. Telp</th>
                            <th style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->email_address }}</td>
                            <td>{{ $order->telp }}</td>
                            <td>
                                <a class="btn btn-md text-light" style="background-color: #8C4660;" href="{{ route('admin.orders.show', $order->id) }}"><i class="fa fa-eye"></i> Lihat</a>
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