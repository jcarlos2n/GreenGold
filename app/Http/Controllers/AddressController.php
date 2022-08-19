<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function addAddress(Request $request){
        try {
            Log::info("Creating new Address");

            $validator = Validator::make($request->all(), [
                'street' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'postal_code' => 'required|integer',
                'country' => 'required|string',
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
            $street = $request->input('street');
            $city = $request->input('city');
            $state = $request->input('state');
            $postal_code = $request->input('postal_code');
            $country = $request->input('country');

            $address = new Address();
            $address->street = $street;
            $address->city = $city;
            $address->state = $state;
            $address->postal_code = $postal_code;
            $address->country = $country;
            $address->user_id = $userId;
            $address->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Address adding"
                ],200);

        } catch (\Exception $exception) {
            Log::error("Error creating new address" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating new address" . $exception->getMessage()
                ],500);
        }
    }
}
