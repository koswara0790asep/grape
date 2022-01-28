<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // menambahkan kondisi untuk menvalidasi keranjang belanja, baru bisa bikin order
        $cart = session()->get('cart');
        if ($cart) {
            return view('admin.orders.create');
        } else {
            return redirect('/')->with('success', 'Anda harus belanja terlebih dahulu!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'email_address' => 'required',
            'telp' => 'required'
        ]);

        $cart = session()->get('cart');
        $total_price = 0;
        foreach($cart as $id => $gallery) {
            $total_price += $gallery['price'] * $gallery['quantity'];
        };

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = 'PENDING';
        $order->email_address = $request->post('email_address');
        $order->telp = $request->post('telp');
        $order->total_price = $total_price;

        $order->save();

        foreach ($cart as $id => $gallery) {
            $orderArt = new OrderItem();
            $orderArt->order_id = $order->id;
            $orderArt->gallery_id = $id;
            $orderArt->quantity = $gallery['quantity'];
            $orderArt->price = $gallery['price'];
            $orderArt->save();
        }

        session()->forget('cart');

        return redirect('admin/orders/'. $order->id)->with('success', 'Pesannan anda berhasil disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if ($order) {
            return view('admin.orders.show', compact('order'));
        } else {
            return redirect('admin.orders')->with('errors', 'Pesannan anda tidak ditemukan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
