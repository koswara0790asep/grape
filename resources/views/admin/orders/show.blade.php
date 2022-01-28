@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-success" style="box-shadow: 5px 5px 5px grey;">Alamat E-mail Pengiriman</span> 
                    </h2>
                    <p>{{ $order->email_address }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-success" style="box-shadow: 5px 5px 5px grey;">Nomor Yang Dapat Dihubungi</span> 
                    </h2>
                    <p>{{ $order->telp }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-success" style="box-shadow: 5px 5px 5px grey;">Harga Total</span> 
                    </h2>
                    <p>{{ $order->total_price }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-striped table-hover table-condensed">
                <thead>
                    <tr>
                        <td style="width: 50%;">Art</td>
                        <td style="width: 18%;">Price</td>
                        <td style="width: 8%;">Quantity</td>
                        <td style="width: 22%;" class="text-center">Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $order)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ asset("/storage/".$order->gallery->art_url) }}" alt="..." width="100" class="img-responsive"></div>
                                <div class="col-sm-9">
                                    <a href="{{ route('galleries.show', $order->gallery->id) }}" class="text-dark">
                                        <h4 class="nomargin">{{ $order->gallery->title }}</h4>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">
                            Rp {{ $order->price }}
                        </td>
                        <td data-th="Quantity" class="text-center">
                            {{ $order->quantity }}
                        </td>
                        <td data-th="Subtotal" class="text-center">
                            Rp {{ $order->price * $order->quantity }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection