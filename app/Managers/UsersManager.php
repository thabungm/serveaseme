<?php
namespace App\Managers;

use App\Dao\UsersDao as UsersDao;
use App\Services\MailService;
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
        
        $mailService = new MailService();
        $passwordArray = array();
        $passwordArray['to'] = $user->email;
        $webClient = config('WEB_CLIENT');
        $passwordArray['reset_link'] = $webClient . "#/resetpassword/" .  $hash;
        
        $sent = $mailService->resetPasswordMail($passwordArray);

        if ($sent) {
            return "Succesfully sent";
        } else {
            return "Error sending mail";
        }
    }

}
