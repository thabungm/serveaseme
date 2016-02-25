<?php
namespace App\Dao;
use App\Models\OrderEnquiryHistory as OrderEnquiryHistory;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\DaoInterface as DaoInterface;
use App\Dao\ItemsDao as ItemsDao;

class OrderHistoryDao extends CommonDao  {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {
        if (isset($inputArray['pickup_date'])) {
            $object->pickup_date = $inputArray['pickup_date'];
        }
        if (isset($inputArray['pickup_time'])) {
            $object->pickup_time = $inputArray['pickup_time'];
        }
        if (isset($inputArray['order_id'])) {
            $object->order_id = $inputArray['order_id'];
        }
        
        
        
        if (isset($inputArray['item_id'])) {
            $object->item_id = $inputArray['item_id'];
        }
        if (isset($inputArray['price'])) {
            $object->price = $inputArray['price'];
        }
        return $object;
    }

    /**
     * 
     * 
     * @param type $request
     */
    function create($request) {
        $orderEnquiryHistory = new OrderEnquiryHistory();
        $orderEnquiryHistory = $this->setProperties($orderEnquiryHistory, $request);
        
        $orderEnquiryHistory->save();
        return $orderEnquiryHistory;
    }

    function read($id) {
        $orderEnquiryHistory = OrderEnquiryHistory::find($id);
        return $orderEnquiryHistory;
    }

    function update($request) {
        $orderEnquiryHistory = OrderEnquiryHistory::find($request['id']);
        if ($orderEnquiryHistory) {
            $orderEnquiryHistory = $this->setProperties($orderEnquiryHistory, $request);
            $orderEnquiryHistory->save();
            return $orderEnquiryHistory;
        }
    }

    function delete($id) {
        OrderEnquiryHistory::destroy($id);
    }
    

    function getOrderEnquiryHistoryByUserId($id) {
        $orderEnquiryHistorys = OrderEnquiryHistory::where('user_id', $id)->get();
        return $orderEnquiryHistorys;
    }
    
    function addToOrderEnquiryHistory($inputArray){
        //@TODO add transaction
//        $itemArray = $itemsDao->read($inputArray['item_id'])->toArray();
        /////////////////////////////

        if ($inputArray['item_id']) {
            $itemsDao = new ItemsDao();

            $itemArray = $itemsDao->read($inputArray['item_id'])->toArray();
        }
        $eoh = new OrderEnquiryHistory();
        $eoh = $this->setProperties($eoh,array_merge($itemArray,$inputArray), $inputArray);
        $eoh->save();
        return $eoh;
    }
    
    
    function getUserEnquiry($userId) {
        
        
    
        
        
    }

}
