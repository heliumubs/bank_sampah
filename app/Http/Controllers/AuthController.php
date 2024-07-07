<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function getCsrfToken()
    {
        return response()->json(['csrfToken' => csrf_token()]);
    }
    public function register(Request $request)
    {
        // var_dump($request);die;
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);
            // var_dump($request->password);die;
        $datauser=User::where('email',$request->email)->count();
        // dd($datauser);
            if($datauser>0){
                return response()->json(['message' => 'Data Sudah Ada'], 500);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'message' => 'User registered successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data'=>$user
            ], 201);
        }
    
        public function login(Request $request)
        {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            $user = User::where('email', $request->email)->first();
            

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'pesan' => 'email atau password salah',
                ]);
            }
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'data'=>$user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    
        public function logout(Request $request)
        {
            $request->user()->currentAccessToken()->delete();
    
            return response()->json(['message' => 'User logged out successfully']);
        }
    }
    