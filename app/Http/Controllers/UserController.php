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
            return redirect()->route('user.dashboard');
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
        
        if(is_null($user_db)){
            toastr()->warning('Usuário não existe no sistema.', 'Sistema');
            return redirect()->back()->withInput();
        }
                
        if(Auth::attempt($data, false)){
            session()->put('permission' ,$user_db->permission);
            return redirect()->route('user.dashboard');
        }
        else{
            toastr()->warning('Senha incorreta!', 'Sistema');
            return redirect()->back()->withInput();
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
