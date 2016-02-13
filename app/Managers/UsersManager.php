<?php
namespace App\Managers;

use App\Dao\UsersDao as UsersDao;

class UsersManager   {

//    function __construct() {
//        
//    }
    
    
    
    
    public function sendResetLink($data) {
        $userDao = new UsersDao();
        
        $user = $userDao->getUserByParam('email', $data['email']);
        if ($user->isEmpty()) {
            throw new \Exception("Email is not registered");
        }
        $user = $user[0];
        $hash = md5(time() . $user->id . 'ASKLD128fjsdfksfuewqekjsu');
        $user->reset_hash = $hash;
        $user->save();
        // send mail
        $webClient = config('WEB_CLIENT');
        $resetLink = $webClient . "#/resetpassword/" .  $hash;
        $sent = \Mail::send('email-template/forgot-password', ['username' => $user->first_name,'reset_link'=>$resetLink], function($message)
        {
            $message->to('thabungm@gmail.com', 'John Smith')->from("thafs@gmail.com")->subject('Welcome!');
        });

        if ($sent) {
            return "Succesfully sent";
        } else {
            return "Error sending mail";
        }
    }

}
