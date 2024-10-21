<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'integer|min:1'
        ]);

        $order = Order::create(['user_id' => auth()->id()]);

        foreach ($request->products as $product) {
            $productModel = Product::find($product['id']);
            if ($productModel->stock >= $product['quantity']) {
                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
                $productModel->decrement('stock', $product['quantity']);
            } else {
                return response()->json(['error' => 'Insufficient stock'], 400);
            }
        }

        event(new OrderPlaced($order));

        return response()->json(['message' => 'Order placed successfully'], 201);
    }

    public function show($id)
    {
        $order = Order::with('products')->find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json($order);
    }
}
