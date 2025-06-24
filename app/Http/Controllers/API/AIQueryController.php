<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class AIQueryController extends Controller
{
    //
    public function handle(Request $request)
    {
         $rules = ([
            'question'=>'required|string',
         ]);
        
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors()->toArray(),422);
        }
    
        $question = strtolower($request->input('question'));

        /* Simulated keyword-based logic (Option A) i am hard coding this to show what the logic will look like
        we can have a table called ai keyword and on that table we have id, keyword, query. Query mean the query that will be 
        ran when the keyword is called from the db */

        if (str_contains($question, 'inventory')) {
            // Where the query will be fetched from the aikeyword db
            $totalQuantity = 1240;
            $totalValue = 5450000;

            return response()->json([
                'status' => 'success',
                'answer' => "The total inventory value is NGN " . number_format($totalValue),
                'breakdown' => [
                    'total_quantity' => $totalQuantity,
                    'total_value' => $totalValue
                ]
            ]);
        }else if(str_contains($question, 'product')){
            $totalProduct = Product::count();

            return response()->json([
                'status' => 'success',
                'answer' => "The total product value is ". $totalProduct,
                'breakdown' => [
                    'total_Product' => $totalProduct
                ]
            ]);
        }

        return response()->json([
            'answer' => 'Sorry, I could not understand your question.'
        ]);
    }
}
