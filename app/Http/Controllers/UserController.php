<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;

class UserController extends Controller
{   
    public function index()
    {
        if(Auth::check()){
            return view('dashboard');
        }
        return view('index');
    }

    public function username()
    {
        return 'username';
    }
    
    public function auth(Request $request){

        $data = [
            'username' => $request['username'],
            'password' => $request['password']
        ];
        
        $user_db = DB::table('users')->where('username', $data['username'])->first();
           
        
        if(is_null($user_db->username)){
            return redirect()->back()->withInput()->withErrors('Usuário não existe no sistema.');
        }
                
        if(Auth::attempt($data, false)){
            return redirect()->route('user.dashboard');
        }
        else{
            return redirect()->back()->withInput()->withErrors('Senha incorreta!');
        }
        
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
