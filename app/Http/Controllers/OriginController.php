<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    public function createOrigin(Request $request){
        try {
            Log::info("Creating new Origin");

            $validator = Validator::make($request->all(), [
                'place' => 'required|string',
                'agricultor' => 'required|string',
            ]);

            if ($validator->fails()) {

                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],400
                );
            };

            $place = $request->input('place');
            $agricultor = $request->input('agricultor');

            $origin = new Origin();
            $origin->place = $place;
            $origin->agricultor = $agricultor;
            $origin->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Origin creating"
                ],200);

        } catch (\Exception $exception) {
            Log::error("Error creating new origin" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating new origin" . $exception->getMessage()
                ],500);
        }
    }
}
