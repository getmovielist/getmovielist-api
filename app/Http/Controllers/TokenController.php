<?php


namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {


        $this->validate($request, [
            'login' => 'required',
            'password' => 'required'
        ]);

        $usuario = User::where('login', $request->login)->first();

        if (is_null($usuario)){
            return response()->json('User not found', 401);
        }

        if(md5($request->password) != trim($usuario->password))
        {
            return response()->json('Password error', 401);
        }

        $token = JWT::encode(
            ['id' => $usuario->id, 'email' => $usuario->email],
            env('JWT_KEY')
        );

        return [
            'id' => $usuario->id,
            'name' => $usuario->name,
            'access_token' => $token
        ];
    }
}
