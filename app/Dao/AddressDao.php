<?php
namespace App\Dao;
use App\Models\Address as Address;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\DaoInterface as DaoInterface;

class AddressDao extends CommonDao implements  DaoInterface {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {
        if (isset($inputArray['full_name'])) {
            $object->full_name = $inputArray['full_name'];
        }
        
        if (isset($inputArray['user_id'])) {
            $object->user_id = $inputArray['user_id'];
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
    function create($request) {
        $address = new Address();
        $address = $this->setProperties($address, $request);
        
        $address->save();
        return $address;
    }

    function read($id) {
        $address = Address::find($id);
        return $address;
    }

    function update($request) {
        $address = Address::find($request['id']);
        if ($address) {
            $address = $this->setProperties($address, $request);
            $address->save();
            return $address;
        }
    }

    function delete($id) {
        Address::destroy($id);
    }
    

    function getAddressByUserId($id) {
//        \DB::enableQueryLog();
        $addresss = Address::where('user_id', $id)->get();
        
        return $addresss;
    }

}
