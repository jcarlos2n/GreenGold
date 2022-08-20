<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(){
        try {
            Log::info("Creating new order");

            // $validator = Validator::make($request->all(), [
            //     'product_id' => 'required'
            // ]);

            // if ($validator->fails()) {

            //     return response()->json(
            //         [
            //             "success" => false,
            //             "message" => $validator->errors()
            //         ],400
            //     );
            // };

            $userId = auth()->user()->id;

            $order = new Order();
            $order->user_id = $userId;
            
            $order->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Order created"
                ],200);

        } catch (\Exception $exception) {
            Log::error("Error creating new order" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating new order" . $exception->getMessage()
                ],500);
        }
    }
}
