<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //create product function
    function addProduct(Request $request) {
        $validator =  Validator::make($request->all(),[
            'product_name' => 'required|string',
            'product_desc' => 'nullable|string',
            'initial_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity' => 'required|string|min:0',
            'category' => 'required|string',
            'product_image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'vendor_id' => 'required|numeric',
            // after numeric|exists:users,id .... to indicate that users id is to be checked
        ],[
            'product_name.required' => 'Product name must be provided.',
            'product_desc.required' => 'Product description is required.',
            'initial_price.required' => 'Initial price must be provided.',
            'initial_price.numeric' => 'Initial price must be a number.',
            'initial_price.min' => 'Initial price must be greater than or equal to 0.',
            'selling_price.required' => 'Selling price must be provided.',
            'selling_price.numeric' => 'Selling price must be a number.',
            'selling_price.min' => 'Selling price must be greater than or equal to 0.',
            'quantity.required' => 'Quantity must be provided.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be greater than or equal to 0.',
            'category.required' => 'Category needs to be allocated.',
            'product_image.required' => 'Product image is required.',
            'product_image.image' => 'Product image must be an image.',
            'product_image.mimes' => 'Product image must be jpg, jpeg or png file.',
            'product_image.max' => 'Product image must must not exceed 5MB.',
            'vendor_id.required' => "Vendor's ID is required.",
            'vendor_id.numeric' => "Vendor ID must be a number.",
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            // create the product
            $product = new Product;
            $product->product_name =$request->input('product_name');
            $product->product_desc = $request->input('product_desc');
            $product->intial_price =$request->input('initial_price');
            $product->selling_price =$request->input('selling_price');
            $product->quantity =$request->input('quantity');
            $product->category =$request->input('category');
            $product->product_image = $request->file('product_image')->store('product_images');
            $product->vendor_id =$request->input('vendor_id');
            
            $product->save();
            return response()->json($product, 201);
        } catch(\Exception $e){
            return response()->json(['errors', $e->getMessage()], 500);
        }
    }  


        function productList(){
            return Product::all();
        }
}
