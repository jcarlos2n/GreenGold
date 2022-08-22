<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder()
    {
        try {
            Log::info("Creating new order");

            $userId = auth()->user()->id;

            $order = new Order();
            $order->user_id = $userId;

            $order->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Order created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error creating new order" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating new order" . $exception->getMessage()
                ],
                500
            );
        }
    }

    public function addProductToOrder(Request $request){
        try {
            Log::info("Creating new Order");
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'product_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };

            $orderId = $request->input("order_id");
            $order = Order::find($orderId);
            
            if (!$order) {
                return [
                    'success' => true,
                    'message' => 'These order doesnt exist'
                ];
            }

            $productId = $request->input('product_id');
            $product = Product::find($productId);

            if (!$product) {
                return [
                    'success' => true,
                    'message' => 'These product doesnt exist'
                ];
            }
            $order->products()->attach($productId);
            // $product->orders()->attach($orderId);
          
            return response()->json([
                'success' => true,
                'message' => "Order created succesfully"
            ], 200);

        } catch (\Exception $exception) {
            Log::error("Error creating new order" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating new order" . $exception->getMessage()
                ],
                500
            );
        }
    }
}
