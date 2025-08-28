<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orders = Order::latest()->paginate(10);
        // return view('orders.user-orders', compact('orders'));
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        // Order::create([
        //     'user_id' => $request->user_id,
        //     'total_price' => $request->total_price,
        //     'payment_method' => $request->payment_method,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('message', 'Ordine eliminato con successo!');
    }
    public function userOrders()
    {
        $orders = Order::where('user_id', auth()->id())->with('orderItems.article')->latest()->paginate(10);

        return view('orders.user-orders', compact('orders'));
    }
    public function adminOrders()
    {
        $orders = Order::latest()->paginate(10);

        return view('dashboard', compact('orders'));
    }
}
