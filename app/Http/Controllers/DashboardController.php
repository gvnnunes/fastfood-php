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

    public function addProduct(Request $request){
        $value = DB::table('products')->where('id', $request->id)->value('value');
        $order_value = $request->amount * $value;
        return response()->json(['id' => $request->id, 'amount' => $request->amount , 'value' => $value,'order_value' => $order_value]);
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
