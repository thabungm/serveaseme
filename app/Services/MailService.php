<?php
namespace App\Services;

class MailService {

    private $sender;
    private $defaultTo;
    private $mailSenderLink;
    private $siteName;

    function __construct() {
        $this->sender = "abc@abc.com";
        $this->defaultTo = "thabungm@gmail.com";
        $this->mailSenderLink = 'http://localhost:3000/mail';
        $this->siteName = config('app_site_name');
    }
    
    function apiCall($method, $url, $data = false) {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    function sendMail($messageArray) {
        if (!isset($messageArray['from'])) {
            $messageArray['from'] = $this->sender;
        }

        if (!isset($messageArray['to'])) {
            $messageArray['from'] = $this->defaultTo;
        }
        if (!isset($messageArray['cc'])) {
            
        }
        $this->apiCall('POST', $this->mailSenderLink, $messageArray); 


        
 
    }

    function sendProductEnquiryMail($enquiryArrayObject) {
        
        $personalDetails = "<ul>";
        foreach( $enquiryArrayObject['personal_details'] as $key=>$value) {
           $personalDetails.="<li>$key :".$value."</li>";
        }
        $personalDetails.="</ul>";
        
        $enquiryItems = "<ul>";
        foreach ($enquiryArrayObject['enquiry_items'] as $key=>$value) {
            $enquiryItems.="<li>$key :".$value."</li>";
            
        }
        $enquiryItems.="</ul>";
        $addressDetails = "<ul>";
        foreach ($enquiryArrayObject['address'] as $key=>$value) {
            $addressDetails.="<li>$key :".$value."</li>";
        }
        $addressDetails.="</ul>";
        $message = 'New enquiry from <br><h2>Personal Details<h2><br><ul><li>' . $personalDetails . '</li> </ul><h2>Address </h2><ul><li>' . $addressDetails. '</li></ul><h2>Orders </h2><ul><li>' . $enquiryItems . '</li></ul>';
        $mailArray = array();
        $mailArray['body'] = $message;
        $mailArray['to'] = 'thabungm@gmail.com';
        $mailArray['cc'] = 'thabung@gmail.com';
        $mailArray['subject'] = 'New product enquiry';
        $this->sendMail($mailArray);

        
        // or
        //$contents = $view->render();
    }
    
    
    function resetPasswordMail($inputArray) {
        try {
        $mailService = new MailService();
        $mailArray = array();
        $mailArray['to'] = $inputArray['to'];
        $inputArray['reset_link'] = $inputArray['reset_link'];
        $mailArray['cc'] = 'thabungm@gmail.com';
        $mailArray['subject'] = 'Reset your password';


        $view = \View::make('email-template/forgot-password', $inputArray);
        $contents = (string) $view;
        
        
        $mailArray['body'] = $contents;
        
        $this->sendMail($mailArray);
        return true;
    } catch (\Exception $e) {
        throw new \Exception($e);

    }
    }

}
