<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class MethodController extends Controller
{
    public function addPaymentMethod(Request $request){
        try {
            Log::info("Creating new Payment Method");

            $validator = Validator::make($request->all(), [
                'method' => 'required|string',
                'method_number' => 'string'
            ]);

            if ($validator->fails()) {

                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],400
                );
            };

            $userId = auth()->user()->id;
            $method = $request->input('method');
            $number = $request->input('method_number');
            
            $payment = new Method();
            $payment->method = $method;
            $payment->method_number = $number;
            $payment->user_id = $userId;
            $payment->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Payment Method adding"
                ],200);

        } catch (\Exception $exception) {
            Log::error("Error adding new payment method" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error adding new payment method" . $exception->getMessage()
                ],500);
        }
    }
}
