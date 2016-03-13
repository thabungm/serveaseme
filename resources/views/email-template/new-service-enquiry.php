<?php $message = 'New enquiry from <br><h2>Personal Details<h2><br><ul><li>'.implode("</li><li>", $enquiryArrayObject['personal_details']).'</li> </ul><h2>Address </h2><ul><li>'.implode("</li><li>". $enquiryArrayObject['address']).'</li></ul>
        <h2>Orders </h2>       
                <ul><li>'.implode("</li><li>", $enquiryArrayObject['enquiry_items']).'</li></ul>'; ?>
        




