<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Clients;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;


use Carbon\Carbon;

class AuthController extends Controller
{
    //register user
//     public function register(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required',
//             'email' => 'required|email',
//             'password' => 'required',
//             'c_password' => 'required|same:password',
//         ]);
// if ($validator->fails()) {
//             return response()->json(['error'=>$validator->errors()], 401);
//         }
// $input = $request->all();
//         $input['password'] = bcrypt($input['password']);
//         $user = User::create($input);
//         $success['access_token'] =  $user->createToken('MyApp')-> accessToken;
//         $success['name'] =  $user->name;
// return response()->json(['success'=>$success], $this-> successStatus);
//     }

   public function register(Request $request)
   {
       $this->validate($request, [
           'name' => 'required|min:4',
           'email' => 'required|email',
           'phone' => 'required',
           'password' => 'required|min:8',
           'c_password' => 'required|same:password',
       ]);

       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
           'password' => bcrypt($request->password)
       ]);

       $token = $user->createToken('access_token')->accessToken;

       if($token){
            return response()->json(['token' => $token, 'message' => 'Successfull'], 200);
       }else{
            return ['message'=>'Failed to register'];
       }


   }


    //login
    public function login(Request $request){

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return ['status'=>false,'message'=>'Invalid email or password'];
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return
        [ 'message'=>'Successful login', 'status'=>true,'user'=>$user, 'access_token' => $tokenResult->accessToken,  'token_type' => 'Bearer',  'expires_at' => Carbon::parse(  $tokenResult->token->expires_at )->toDateTimeString()
        ];
    }

    //get user
    public function user()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    //logout
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


    public function changepass(Request $request){
        $this->validate($request, [
            'oldpass' => 'required|min:3',
            'newpass' => 'required|min:3',
            'c_newpass' => 'required|min:3',
        ]);

        //Get the current authenticated user password
        $$oldpass = auth::user()->password;

        //Check if passwords match
        if (!Hash::check($request['oldpass'], $oldpass)) {
            return ['message'=>'The old password is wrong'];
        } elseif ($request->input('newpass') !== $request->input('repass')) {
            return ['message'=> 'Sorry the new passwords don\'t match.'];
        }

        //Update password
        $id = auth::user()->id;
        $currentUser = User::findOrFail($id);

        $currentUser->password = Hash::make($request->input('newpass'));
        $currentUser->save();

        return [ 'status'=>true, 'message'=> 'Password changed ,You must logout to login in with  new passoword'];
    }

}
