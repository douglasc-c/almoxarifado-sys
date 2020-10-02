<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            
            return response()->json(['status' => true, 'user' => $user]);
        }
        return response()->json(['status' => false, 'message' => 'Email ou senha esta incorreto!']);
    }

    public function register(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            $user = User::create([
                'name' => strip_tags($request['name']),
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'token' => Str::random(10),
            ]);

            return response()->json(['status' => true, 'user' => $user, 'message' => 'Email cadastrado!']);
        }
        return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    }

    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        if ($user){

            $user->delete();
            
            return response()->json(['status' => true, 'message' => 'Usuário apagado da plataforma!']);
        }
        return response()->json(['status' => false, 'message' => 'E-mail não encontrado na plataforma!']);
    }
    
}
