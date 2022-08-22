<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        try {
            Log::info("Adding new product");

            $validator = Validator::make($request->all(), [
                'variety' => 'required|string|max:150',
                'description' => 'required|string|max:255',
                'price' => 'required',
                'image' => 'required|string',
                'origin_id' => 'required|integer'
            ]);

            if ($validator->fails()) {

                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],400
                );
            };

            $variety = $request->input('variety');
            $description = $request->input('description');
            $price = $request->input('price');
            $image = $request->input('image');
            $origin = $request->input('origin_id');

            $product = new Product();
            $product->variety = $variety;
            $product->description = $description;
            $product->price = $price;
            $product->image = $image;
            $product->origin_id = $origin;
            $product->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Product adding"
                ],200);

        } catch (\Exception $exception) {
            Log::error("Error adding new product" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error adding new product" . $exception->getMessage()
                ],500);
        }
    }

    public function getProducts(){
        try {
        Log::info("Getting products");

        $products = Product::query("products")
        ->get()
        ->toArray();

        return response()->json([
            'success' => true,
            'message' => 'Products retrieve succesfully',
            'data' => $products
        ],200);

        } catch (\Exception $exception) {
            Log::error("Error getting products: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error getting products. ' . $exception->getMessage(),

            ], 500);
        }
    }
}
