<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class PassportController extends Controller
{
    /**
     * Register user.
     *
     * @return json
     */

 public function showall()
    {
        $users = User::all()->where('role', 'admin');
        if ($users == "") {
            return response()->json([
                'success' => true,
                'message' => 'Users Not Found Done.',
                // 'data' => $Items

            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Users Fetch Successfully Done.',
                'data' => $users

            ], 200);
        }
    }


     public function showallclients()
    {
        $users = $users = User::all()->where('role','Customer');
        if ($users == "") {
            return response()->json([
                'success' => true,
                'message' => 'Users Not Found Done.',
                // 'data' => $Items

            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Users Fetch Successfully Done.',
                'data' => $users

            ], 200);
        }
    }

  public function register(Request $request)
    {
        $input = $request->only(['name', 'email', 'password', 'confirm_password', 'role','gender']);

        $validate_data = [
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'same:password|required',
            'role'  => 'required',
            'gender'  => 'required',
              
        ];

        $validator = Validator::make($input, $validate_data);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'confirm_password' => Hash::make($input['confirm_password']),
            'role'  => $input['role'],
            'gender'  => $input['gender'],
            
           
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User registered succesfully, Use Login method to receive token.'
        ], 200);
    }

 
    /**
     * Login user.
     *
     * @return json
     */
    public function login(Request $request)
    {
        $input = $request->only(['email', 'password']);

        $validate_data = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        // authentication attempt
        if (auth()->attempt($input)) {
            $token = auth()->user()->createToken('passport_token')->accessToken;
            
            return response()->json([
                'success' => true,
                'message' => 'User login succesfully, Use token to authenticate.',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User authentication failed.'
            ], 401);
        }
    }


public function show($id)
    {
        $user = User::where('id', $id)->where('role','Customer')->get();

        if ($user->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'User Details Not Found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'User Details Found',
            'data' => $user
        ], 200);
    }



     public function update_users(Request $request, $id)
    {

        $sales = new User();
        $sales = User::find($id);

        if ($sales) {
            $sales->name = $request->name;
            $sales->email = $request->email;
            $sales->password = Hash::make($request->password);
            $sales->confirm_password = Hash::make($request->confirm_password);
           // $sales->role = $request->role;
            $sales->gender = $request->gender;


            $sales->save();

            return response()->json([
                'success' => true,
                'message' => ' Given Details Updated Successfully.'
            ], 200);
        }
    }

    /**
     * Access method to authenticate.
     *
     * @return json
     */
    public function userDetail()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data fetched successfully.',
            'data' => auth()->user()
        ], 200);
    }

    /**
     * Logout user.
     *
     * @return json
     */
    public function logout()
    {
        $access_token = auth()->user()->token();

        // logout from only current device
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($access_token->id);

        // use this method to logout from all devices
        // $refreshTokenRepository = app(RefreshTokenRepository::class);
        // $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($$access_token->id);

        return response()->json([
            'success' => true,
            'message' => 'User logout successfully.'
        ], 200);
    }
}