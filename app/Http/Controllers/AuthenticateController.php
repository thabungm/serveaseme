<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
//use App\Models\User;
use Socialite;
use Auth;
use App\Dao\UsersDao;

class AuthenticateController extends Controller
{
    public function __construct() {
        
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }
    
    
    
    
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }

    /**
     * Obtain the user information from Facebook
     *
     * @return Response
     */
    public function handlefbCallback()
    {   
        $user = Socialite::driver('facebook')->user();
        $data=array();
        $data['first_name'] = $user->getName();
        $data['email'] = $user->getEmail();
        $usersDaoObj = new UsersDao();
        $user = $usersDaoObj->authSocialLogin($data);
        $token = JWTAuth::fromUser($user);
        return $this->jsonResponse(compact('token'));
    }
    
    public function authenticateSocial() {
        
    }
    
}
