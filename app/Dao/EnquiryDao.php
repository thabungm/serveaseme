<?php

namespace App\Dao;

use App\Models\Enquiry as Enquiry;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\DaoInterface as DaoInterface;
use App\Events\EnquiryWasMade as EnquiryWasMade;

class EnquiryDao extends CommonDao {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {

        if (isset($inputArray['item_id'])) {
            $object->item_id = $inputArray['item_id'];
        }

        if (isset($inputArray['address_id'])) {
            $object->address_id = $inputArray['address_id'];
        }

        if (isset($inputArray['id'])) {
            $object->id = $inputArray['id'];
        }
        return $object;
    }

    /**
     * 
     * 
     * @param type $request
     */
    function create($request) {
        $enquiry = new Enquiry();
        $enquiry = $this->setProperties($enquiry, $request);
        $enquiry->save();
        return $enquiry;
    }

    function placeEnquiry($request) {

        foreach ($request['items'] as $value) {
            $this->create(array('item_id' => $value, 'address_id' => $request['address_id']));
        }

        \Illuminate\Support\Facades\Event::fire(new EnquiryWasMade());
    }

    function read($id) {
        $enquiry = Enquiry::find($id);
        return $enquiry;
    }

    function update($request) {
        $enquiry = Enquiry::find($request['id']);
        if ($enquiry) {
            $enquiry = $this->setProperties($enquiry, $request);
            $enquiry->save();
            return $enquiry;
        }
    }

    function delete($id) {
        Enquiry::destroy($id);
    }

    function getEnquiryByUserId($id) {
//        \DB::enableQueryLog();
        $enquiry = Enquiry::where('user_id', $id)->get();

        return $enquiry;
    }

    function getEnquiryByStatus($status = "new", $formatIt = true) {

        $query = "select address_item.*, users.id as user_id, users.first_name as first_name, users.last_name as last_name from
(
 select address.*,item_enquiry.status,item_enquiry.address_id as address_id, item_enquiry.item_name as item_name,item_enquiry.item_id as item_id from
   (
	select enquiry.status as status,enquiry.address_id as address_id, items.name as item_name,items.id as item_id from
	items
	JOIN
	enquiry
	on items.id = enquiry.item_id
        where enquiry.status =?


   ) item_enquiry
JOIN
address
ON
item_enquiry.address_id = address.id




) address_item
JOIN 
users
ON
address_item.user_id = users.id
";

        $enquiries = \DB::select($query, [$status]);
        if (!$formatIt) {
            return $enquiries;
        }
        $personalDetailsNotSet = true;
        $personalDetails = [];
        $returnArray = [];
        $address = [];
        $enquiryItems = [];
//        print_r($enquiries);
//        die();
        foreach ($enquiries as $value) {
//            print_r($value);
//            die();
            if ($personalDetailsNotSet) {
                $personalDetails['User Name'] = $value->first_name . " " . $value->last_name;
                $personalDetails['id'] = $value->user_id;
                $address['Full name'] = $value->full_name;
                $address['id'] = $value->address_id;
                $address['Mobile Number'] = $value->mobile_number;
                $address['State'] = $value->state;
                $address['City'] = $value->city;
                $address['Area'] = $value->area;
                $address['Landmark'] = $value->landmark;
                $address['Pin'] = $value->pin;
            }

            $enquiryItems[$value->item_id] = $value->item_name;
        }

        if (!empty($enquiryItems)) {

            $returnArray ['personal_details'] = $personalDetails;
            $returnArray ['address'] = $address;
            $returnArray ['enquiry_items'] = $enquiryItems;
        }

        
        

        return $returnArray;
    }

}
