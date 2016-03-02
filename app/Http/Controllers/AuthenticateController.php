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
//            $credentials['ttl'] = 1;
            // verify the credentials and create a token for the user
            
            
//            $jwt = \Illuminate\Support\Facades\Config::get('jwt');
//            $jwt['ttl'] = 1;
//            \Illuminate\Support\Facades\Config::set('jwt',$jwt);
            
//            $app['config']
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::toUser($token);
        $resp = array();
        $resp['user'] = $user;
        $resp['token'] = $token;
        // if no errors are encountered we can return a JWT
        return $this->jsonResponse($resp);
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
        $data['social_site_id'] = $user->getId();
        $data['email'] = $user->getEmail();
        $usersDaoObj = new UsersDao();
        $user = $usersDaoObj->authSocialLogin($data);
        $token = JWTAuth::fromUser($user);
        //$env = \App::environment();
       
        
        return redirect()->away(env('WEB_CLIENT') . "auth-token/" . $token);
        
    }
    
    public function getUserByToken() {
        
        $user = JWTAuth::parseToken()->authenticate();
        return $this->jsonResponse($user);
    }
    
}
