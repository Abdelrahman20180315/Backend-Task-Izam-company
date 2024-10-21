<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return Cache::remember('products', now()->addMinutes(10), function () use ($request) {
            $query = Product::query();

            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('min_price') && $request->has('max_price')) {
                $query->whereBetween('price', [$request->min_price, $request->max_price]);
            }

            return $query->paginate(10);
        });
    }
}
