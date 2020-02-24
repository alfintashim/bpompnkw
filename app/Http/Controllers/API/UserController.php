<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\SignupActivate;
use Avatar;
use Storage;
use App\Helper;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            // 'username' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Gagal Login',
                'success' => 'false'
            ], 200);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return response()->json([
            'message' => 'Login Sukses',
            'success' =>'true',
            'type' => auth()->user()->id_role,
            'users'     => $request->user(),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
            ],200
        );
    }

    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] username
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */

    public function signup(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'username' => 'required|string|unique:users',
        //     'email' => 'required|string|email|unique:users',
        //     'password' => 'required|string|confirmed'
        // ]);

        // $ktp = 'no-image.jpg';
        // $foto = 'user.jpg';

        $user = new User([
            'id_role' => '4',
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60)
        ]);

        $user->save();

        Helper::createBiouser(
            $user->id 
            // $ktp,
            // $foto
        );

        // $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        // Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);

        $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }

        $user->active = true;
        $user->activation_token = '';
        $user->save();

        // return $user;
        return response()->json([
            'message' => 'Successfully activated!'
        ]);
    }

    public function gantiPassword(Request $request)
    {

        $id = auth('api')->user()->id;

        $user =  User::findOrFail($id);
        $user->password          = bcrypt($request->password);
        // $user->password_confirm  = $request->password_confirm;
        $user->save();

        return response()->json([
            'message' => 'Password Berhasil Diubah'
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function usernameRegister(Request $request)
    {
        $user = User::where('username',$request->username)->first();
        if($user != ''){
            return response()->json([
                'message' => 'Ada'
            ]);
        }else{
            return response()->json([
                'message' => 'Tidak Ada'
            ]);
        }
    }

    public function emailRegister(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user != ''){
            return response()->json([
                'message' => 'Ada'
            ]);
        }else{
            return response()->json([
                'message' => 'Tidak Ada'
            ]);
        }
    }
}
