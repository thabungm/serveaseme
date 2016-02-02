<?php
namespace App\Dao;
use App\Models\OrderHasItems as OrderHasItems;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\DaoInterface as DaoInterface;

class OrderHasItemsDao extends CommonDao implements  DaoInterface {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {
        if (isset($inputArray['order_id'])) {
            $object->order_id = $inputArray['order_id'];
        }
        if (isset($inputArray['item_id'])) {
            $object->item_id = $inputArray['item_id'];
        }
        
        return $object;
    }

    /**
     * 
     * 
     * @param type $request
     */
    function create($request) {
        $item = new OrderHasItems();
        $item = $this->setProperties($item, $request);
        $item->save();
        return $item;
    }

    function read($id) {
        $item = OrderHasItems::find($id);
        return $item;
    }

    function update($request) {
        $item = OrderHasItems::find($request['id']);
        if ($item) {
            $item = $this->setProperties($item, $request);
            $item->save();
            return $item;
        }
    }

    function delete($id) {
        OrderHasItems::destroy($id);
    }
    

    function getOrderHasItemsByOrderId($id) {

        $orderHasItems = OrderHasItems::where('order_id', $id)->get();
        return $orderHasItems;
    }
    
    function getOrderHasItemsByOrderItemId($id) {

        $orderHasItems = OrderHasItems::where('item_id', $id)->get();
        return $orderHasItems;
    }

}
