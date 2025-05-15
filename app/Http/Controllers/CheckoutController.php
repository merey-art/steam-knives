<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Knife;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $items  = session('cart', []);
        $knives = Knife::whereIn('id', array_keys($items))->get();
        $total  = $knives->sum(fn($k) => $k->price * $items[$k->id]);

        return view('checkout.index', compact('knives','items','total'));
    }

    public function store(Request $request)
    {
        $items = session('cart', []);
        if (empty($items)) {
            return redirect()->route('checkout.index')->with('error', 'Корзина пуста.');
        }

        $knives = Knife::whereIn('id', array_keys($items))->get();
        $total  = $knives->sum(fn($k) => $k->price * $items[$k->id]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total'   => $total,
            'status'  => 'pending',
        ]);

        foreach ($knives as $knife) {
            OrderItem::create([
                'order_id' => $order->id,
                'knife_id' => $knife->id,
                'quantity' => $items[$knife->id],
                'price'    => $knife->price,
            ]);
        }

        session()->forget('cart');

        Mail::to($order->user->email)
            ->queue(new OrderPlaced($order));

        //администратору
        Mail::to(config('mail.admin_address', env('ADMIN_EMAIL')))
            ->queue(new OrderPlaced($order));

        session()->forget('cart');

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}
