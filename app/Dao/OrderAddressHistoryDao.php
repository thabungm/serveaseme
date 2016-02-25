<?php
namespace App\Dao;
use App\Models\OrderAddressHistory as OrderAddressHistory;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\DaoInterface as DaoInterface;

class OrderAddressHistoryDao extends CommonDao  {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {
        if (isset($inputArray['full_name'])) {
            $object->full_name = $inputArray['full_name'];
        }
        
        if (isset($inputArray['enquiry_id'])) {
            $object->enquiry_id = $inputArray['enquiry_id'];
        }
        
        if (isset($inputArray['order_id'])) {
            $object->order_id = $inputArray['order_id'];
        }
        if (isset($inputArray['area'])) {
            $object->area = $inputArray['area'];
        }
        if (isset($inputArray['address'])) {
            $object->address = $inputArray['address'];
        }
        if (isset($inputArray['pin'])) {
            $object->pin = $inputArray['pin'];
        }
        
        if (isset($inputArray['landmark'])) {
            $object->landmark = $inputArray['landmark'];
        }
        if (isset($inputArray['city'])) {
            $object->city = $inputArray['city'];
        }
        
        if (isset($inputArray['state'])) {
            $object->state = $inputArray['state'];
        }
        
        if (isset($inputArray['mobile_number'])) {
            $object->mobile_number = $inputArray['mobile_number'];
        }
        return $object;
    }

    /**
     * 
     * 
     * @param type $request
     */
    function create($inputArray) {
        if ($inputArray['address_id']) {
            $addressDao = new AddressDao();
            $address = $addressDao->read($inputArray['address_id'])->toArray();
        }
        
        
        $eoah = new OrderAddressHistory();
        $eoah = $this->setProperties($eoah,array_merge($address,$inputArray));
        $eoah->save();
        return $eoah;
    }

    function read($id) {
        $address = OrderAddressHistory::find($id);
        return $address;
    }

    function update($request) {
        $address = OrderAddressHistory::find($request['id']);
        if ($address) {
            $address = $this->setProperties($address, $request);
            $address->save();
            return $address;
        }
    }

    

}
