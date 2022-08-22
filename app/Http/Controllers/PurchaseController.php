<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function createPurchase($id)
    {
        try {
            Log::info("Creating new purchase");

            $purchase = Order::find($id);
            if (!$purchase) {
                return [
                    'success' => true,
                    'message' => 'These order doesnt exist'
                ];
            }
            $purchase = new Purchase();
            $purchase->order_id = $id;
            $purchase->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Purchase created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error creating new purchase" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating new purchase" . $exception->getMessage()
                ],
                500
            );
        }
    }
}
