<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $products = DB::table('products')->get();

            return view('dashboard', ['products' => $products]);
        }
        return redirect()->route('user.index');
    }

    public function addProductToCart(Request $request){
        $value = DB::table('products')->where('id', $request->id)->value('value');
        $order_value = $request->amount * $value;
        return response()->json(['id' => $request->id, 'amount' => $request->amount , 'value' => $value,'order_value' => $order_value]);
    }

    public function showProductsOnCart(Request $request){
        $products = $request->products;
        $product_list = [];
        for($i = 0; $i < count($request->products); $i++){            
            $product = explode(" ", $products[$i]);
            $product_id = $product[0];
            $product_amount = $product[1];
            $product_total_value = $product[2];
            $product_name = DB::table('products')->where('id', $product_id)->value('name');
            $product_information = $product_id . ' ' . $product_name . ' ' . $product_amount. ' ' . $product_total_value;
            array_push($product_list, $product_information);
        }
        return response()->json($product_list);
    }
    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
