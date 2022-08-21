<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Rules\CheckCurrentPassword;
use App\Rules\CompareNewPasswordWithOld;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(Request $request) {
      
        $request->validate([
            'name'=>['required'],
            'email'=>['required', 'unique:users,email'],
            'password'=>['required', 'min:6', 'confirmed']

        ]);
        //create user
        $user = User::create([
            'name' => $request-> name,
            'email'=> $request-> email,
            'password' => Hash::make($request->password)
        ]);


        //create token
        $token = $user -> createtoken('default')->plainTextToken;

        return response()->json([
            'success'=> true,
            'message'=>'registration successful',
            'data' =>[
                'token' => $token,
                'user' => new UserResource ($user)
            ]
        ]);        
    }
    
    public function login(Request $request){
        $request->validate([
            'email'=>['required'],
            'password'=>['required'],
        ]);
        //check user with email and check if password is correct
        $user = User::where('email', $request->email)->first();
        
        
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'success'=> false,
                'message'=>'incorrect email or password'
    
                
            ]);
        }

        //dwlete any other existing token for user
        $user->tokens()-> delete();

        //create a new token
        $token = $user -> createtoken('login')->plainTextToken;

        //return token
        return response()->json([
            'success'=> true,
            'message'=>'login successful',
            'data' =>[
                'token' => $token,
                
            ]
        ]); 

    }

    public function logout(Request $request){
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'success'=> true,
            'message'=>' user logged out'
        ]);
    }


    public function changePassword(Request $request){
        $request->validate([
            'current_password'=>['required', new CheckCurrentPassword()],
            'new_password'=>['required',/*new CompareNewPasswordWithOld()*/ 'confirmed']
        ]);

        $user= auth('sanctum')->user();
        if( Hash::check($request->new_password, $user->password)){
            return response()->json([
                'success'=> false,
                'message'=>'password matches with current password',
                
            ]);

        }

        $user ->update(['password'=> Hash::make($request->new_password)]);

        
        //dwlete any other existing token for user
        $user->tokens()-> delete();

        //create a new token
        $token = $user -> createtoken('login')->plainTextToken;


        
        return response()->json([
            'success'=> true,
            'message'=>'password updated',
            'data' =>['token'=> $token]
        ]);
    } 
    
    public function accountDelete(Request $request){
        
        $request->validate([
            'password'=>['required'],
        ]);
        //check user with email and check if password is correct
        $user = auth('sanctum')->user();
        
        
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'success'=> false,
                'message'=>'incorrect password'
    
                
            ]);
        }   
        $user-> delete();
        return response()->json([
            'success'=> true,
            'message'=>'the rubbish account has been deleted'

            
        ]);
    }
}
