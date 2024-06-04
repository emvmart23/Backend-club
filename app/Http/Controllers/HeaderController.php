<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Header;
use App\Models\Order;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            "mozo" => "required|string",
        ]);

        $header = Header::create($data);

        return response()->json([
            "Header" => $header
        ], 200);
    }

    public function show()
    {
        $headers = Header::with('orders')->get()->map(function ($header) {
            return [
                'id' => $header->id,
                'mozo' => $header->mozo,
                'state' => $header->state,
                'created_at' => $header->created_at,
                'orders' => $header->orders->map(function ($order) {
                    return [
                        'name' => $order->name,
                        'count' => $order->count,
                        'total_price' => $order->total_price,
                        'hostess' => $order->hostess,
                        'date_order' => $order->created_at
                    ];
                }),
            ];
        });

        return response()->json($headers);
    }

    public function attended($id)
    {
        $header = Header::find($id);
        $header->state = false;
        $header-> save();

        return response()->json([
            "header" => $header
        ], 200);
    }
}
