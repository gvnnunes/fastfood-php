<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        for($i = 0; $i < count($products); $i++){            
            $product = explode("-", $products[$i]);
            $product_id = $product[0];
            $product_amount = $product[1];
            $product_total_value = $product[2];
            $product_name = DB::table('products')->where('id', $product_id)->value('name');
            $product_information = $product_id . '-' . $product_name . '-' . $product_amount. '-' . $product_total_value;
            array_push($product_list, $product_information);
        }
        return response()->json($product_list);
    }

    public function checkout(Request $request){
        $product_list = "";
        $products = $request->products;
        $order_value_total = $request->order_value_total;
        $money_value = $request->money_value;
        $change_value = $request->change_value;
        $customer_name = $request->customer_name;
        for ($i = 0; $i < count($products); $i++){
            $product_list .= $products[$i] . '|';
        }
        $order_id = DB::table('orders')->insertGetId([
            'products' => $product_list,
            'order_value_total' => $order_value_total,
            'payment_value' => $money_value,
            'change_value' => $change_value,
            'customer_name' => $customer_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return response()->json($order_id);
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
