<?php

namespace App\Listeners;

use App\Events\EnquiryWasMade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Dao\EnquiryDao as EnquiryDao;
use App\Services\MailService as MailService;

class MailEnquiryWasMade implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
//         $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  EnquiryWasMade  $event
     * @return void
     */
    public function handle(EnquiryWasMade $event)
    {
        $enquiryDao = new EnquiryDao();
        $enquiryArrayObject = $enquiryDao->getEnquiryByStatus();
        
        if (!empty($enquiryArrayObject)) {
            $mailService = new MailService();
            $mailService->sendProductEnquiryMail($enquiryArrayObject);
        }
        
        return false;
    }
}
