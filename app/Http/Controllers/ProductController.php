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
        ->where("status", "=", 1)
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

    public function getProductById($id){
        try {
            $product = Product::query()
            ->where('id' , '=', $id)
            ->get();

            if (!$product) {
                return [
                    'success' => true,
                    "message" => "These product doesn't exist"
                ];
            }
            Log::info("Getting product");

            return response()->json([
                'success' => true,
                'message' => 'Product retrieve successfully',
                'data' => $product
            ], 200);

        } catch (\Exception $exception) {

            Log::error("Error getting product: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting product' . $exception->getMessage(),

            ], 500);
        }
    }

    public function updateProduct(Request $request, $id){
        try {
            $product = Product::query()
            ->where('id', '=', $id)
            ->first();

            if (!$product) {
                return[
                    'success' => true,
                    'message' => 'These product doesn´t exist'
                ];
            }

            Log::info("Updating Product");

            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    "success" => true,
                    "message" => "Product doesnt exist"
                ], 404);
            }

            $variety = $request->input('variety');
            $description = $request->input('description');
            $price = $request->input('price');
            $image = $request->input('image');
            $origin = $request->input('origin_id');

            $product->variety = $variety;
            $product->description = $description;
            $product->price = $price;
            $product->image = $image;
            $product->origin_id = $origin;

            $product->save();

            return response()->json([
                "success" => true,
                "message" => "Product updated"
            ], 200);

        } catch (\Exception $exception) {
            
            Log::error("Error updating product: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating product' . $exception->getMessage(),
            ], 500);
        }
    }

    public function changeStatusProduct (Request $request, $id){
        try {
            $product = Product::query()
            ->where('id', '=', $id)
            ->first();

            if (!$product) {
                return[
                    'success' => true,
                    'message' => 'These product doesn´t exist'
                ];
            }

            Log::info("Change status Product");

            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    "success" => true,
                    "message" => "Product doesn't exist"
                ], 404);
            }

            $status = $request->input('status');
            
            $product->status = $status;

            $product->save();

            return response()->json([
                "success" => true,
                "message" => "Status product changed"
            ], 200);

        } catch (\Exception $exception) {
            
            Log::error("Error changing status product: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error changing status product' . $exception->getMessage(),
            ], 500);
        }
    }
}
