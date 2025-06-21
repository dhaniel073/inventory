<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    public function products(){
        //view product by if
        $product = Product::all();

        //return response
        return response()->json($product);
    }

    public function createproduct(Request $request){
        //validate input
        $rules = ([
            'name'=>'required|string|max:120|unique:products,name',
            'quantity'=>'required|gt:0',
            "status" => 'required|string|size:1|in:A,U,D',
            'cost_price'=>'required|numeric|max:9999999999|gt:0',
            'selling_price'=>'required|numeric|max:9999999999|gt:0',
        ]);

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors()->toArray(),422);
        }

        // create a unique sku that can later be converted to bar code
        $sku = strtoupper(Str::slug($request->name)) . '-' . strtoupper(Str::random(5));

        //get logged in user
        $user = $request->user();
        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Only admins have permission to create products. Contact your admin for more information.'
            ], 403);
        }

        //create product
        $product = new Product();
        $product->name =  strip_tags($request->input('name'));
        $product->sku = $sku;
        $product->quantity = strip_tags($request->input('quantity'));
        $product->status = strip_tags($request->input('status'));
        $product->cost_price = strip_tags($request->input('cost_price'));
        $product->selling_price = strip_tags($request->input('selling_price'));
        $product->save();
        
        //return response
        return response()->json($product);
    }

    public function deleteproduct(Request $request, $id)
    {
        //200=>Ok, 403=>forbidden, 500=>internal server error
        //get logged in user
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Only admins have permission to delete products. Contact your admin for more information.'
            ], 403);
        }


        //find product using the product id and set the status of the product to D meaning Deleted
        //A ---> Available, U -----> Unavailable, D ------> Deleted.
        try {
            $product = Product::findOrFail($id);
            $product->status = 'D';
            $product->save();

            return response()->json([
                'message' => 'Product deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function viewproduct(Request $request, $id){
        //view product by if
        $product = Product::findOrFail($id);

        //return response
        return response()->json($product);
    }

    public function unavailproduct(Request $request, $id)
    {
        //200=>Ok, 403=>forbidden, 500=>internal server error
         //get logged in user
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Only admins have permission to delete products. Contact your admin for more information.'
            ], 403);
        }

        //find product using the product id and set the status of the product to U meaning unavailable
        //A ---> Available, U -----> Unavailable, D ------> Deleted.
        try {
            $product = Product::findOrFail($id);
            $product->status = 'U';
            $product->save();

            return response()->json([
                'message' => 'Product set to unavailable successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to set the status of the product to unavailable.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function availproduct(Request $request, $id)
    {
        //200=>Ok, 403=>forbidden, 500=>internal server error
        //get logged in user
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Only admins have permission to delete products. Contact your admin for more information.'
            ], 403);
        }

        //find product using the product id and set the status of the product to A meaning available
        //A ---> Available, U -----> Unavailable, D ------> Deleted.
        try {
            $product = Product::findOrFail($id);
            $product->status = 'A';
            $product->save();

            return response()->json([
                'message' => 'Product set to available successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to set the status of the product to available.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function updateproduct(Request $request, $id)
    {
        $rules = ([
            'name'=>'required|string|max:120|unique:products,name,'.$id,
            'quantity'=>'required|gt:0',
            "status" => 'required|string|size:1|in:A,U,D',
            'cost_price'=>'required|numeric|max:9999999999|gt:0',
            'selling_price'=>'required|numeric|max:9999999999|gt:0',
        ]);

        //validate inputs
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors()->toArray(),422);
        }

        //check logged in user
        $user = $request->user();
        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Only admins have permission to create products. Contact your admin for more information.'
            ], 403);
        }

        //update product
        $product = Product::findOrFail($id);
        $product->name =  strip_tags($request->input('name'));
        $product->quantity = strip_tags($request->input('quantity'));
        $product->status = strip_tags($request->input('status'));
        $product->cost_price = strip_tags($request->input('cost_price'));
        $product->selling_price = strip_tags($request->input('selling_price'));
        $product->save();
        
        //return response
        return response()->json($product);
    }
}