<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('carts.index');
    }

    public function add(Gallery $gallery)
    {
        if(!$gallery){
            abort(404);
        }
        
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $gallery['id'] => [
                    "title" => $gallery->title,
                    "quantity" => 1,
                    "price" => $gallery->price,
                    "art_url" => $gallery->art_url
                ]
            ];

            session()->put('cart', $cart);

            return redirect('/carts')->with('success', 'Art added to cart successfully');
        }

        if (isset($cart[$gallery['id']])) {
            $cart[$gallery['id']]['quantity']++;

            session()->put('cart', $cart);

            return redirect('/carts')->with('success', 'Art added to cart successfully');
        }

        $cart[$gallery['id']] = [
            "title" => $gallery->title,
            "quantity" => 1,
            "price" => $gallery->price,
            "art_url" => $gallery->art_url
        ];
        
        session()->put('cart', $cart);

        return redirect('/carts')->with('success', 'Art added to cart successfully');
    }

    public function update()
    {
        if (request('id') and request('quantity')) {
            $cart = session()->get('cart');
            
            $cart[request('id')]['quantity'] = request('quantity');

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove()
    {
        if (request('id')) {
            $cart = session()->get('cart');

            if (isset($cart[request('id')])) {
                
                unset($cart[request('id')]);

                session()->put('cart', $cart);
            }
            session()->flash('success', 'Art removed successfully');
        }
    }
}
