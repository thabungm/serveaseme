<?php

namespace App\Dao;

use App\Models\Orders as Orders;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\OrderHasItemsDao as OrderHasItemsDao;
use App\Dao\DaoInterface as DaoInterface;

class OrdersDao extends CommonDao implements  DaoInterface {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {
        if (isset($inputArray['address_id'])) {
            $object->address_id = $inputArray['address_id'];
        }
        if (isset($inputArray['status'])) {
            $object->status = $inputArray['status'];
        }
        if (isset($inputArray['updated_by'])) {
            $object->updated_by = $inputArray['updated_by'];
        }
        return $object;
    }

    /**
     * 
     * 
     * @param type $request
     */
    function create($request) {
        $order = new Orders();
        $order = $this->setProperties($order, $request);
        $order->save();
        return $order;
    }

    function read($id) {
        $order = Orders::find($id);
        return $order;
    }

    function update($request) {
        $order = Orders::find($request['id']);
        if ($order) {
            $order = $this->setProperties($order, $request);
            $order->save();
            return $order;
        }
    }

    function delete($id) {
        Orders::destroy($id);
    }

    function getOrdersByCategory($id) {

        $orders = Orders::where('category_id', $id)->get();
        return $orders;
    }
    

    function placeOrder($data) {
        
//        print_r($data);
//        die();
        //@TODO: put transaction checkpoint
        //@TODO: put validation rules
        $orderArray = array();
        $orderArray['address_id'] = $data['address_id'];
        $orderArray['updated_by'] = $data['updated_by'];
        $order = $this->create($orderArray);
        // insert into orderHasItems
        $odhiDao = new OrderHasItemsDao();
        $orderHasitemArray = array();
        $orderHasitemArray['order_id'] = $order->id;
//        print_r($order);
//        print_r($data);
//        die();
        foreach($data['items'] as $val) { 
            $orderHasitemArray['item_id'] = $val;
            $odhiDao->create($orderHasitemArray);
        }
        return $order;
        //@TODO: put transaction commit
    }

}
