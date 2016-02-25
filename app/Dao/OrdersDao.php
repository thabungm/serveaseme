<?php

namespace App\Dao;

use App\Models\Orders as Order;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\DaoInterface as DaoInterface;
use App\Events\OrderWasMade as OrderWasMade;
use App\Dao\OrderHasItemsDao as OrderHasItemsDao;
use App\Dao\OrderHistoryDao as OrderHistoryDao;
use App\Dao\OrderAddressHistoryDao as OrderAddressHistoryDao;
///var/www/html/laravel/app/Dao/OrderHistoryDao.php
class OrdersDao extends CommonDao {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {

        if (isset($inputArray['pickup_date'])) {
            $object->pickup_date = $inputArray['pickup_date'];
        }
        if (isset($inputArray['pickup_time'])) {
            $object->pickup_time = $inputArray['pickup_time'];
        }
        
        
        
        if (isset($inputArray['user_id'])) {
            $object->user_id = $inputArray['user_id'];
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
        $order = new Order();
        $order = $this->setProperties($order, $request);
        $order->save();
        return $order;
    }

    function placeOrder($request) {

        //@TODO: transaction starts
//        echo 
        $order = $this->create($request);
        $orderHasItemsDao = new OrderHasItemsDao();
        $eoahDao = new OrderAddressHistoryDao();
        $eoahDao->create(array('order_id'=>$order->id,'address_id'=>$request['address_id']));
        $orderOrderHistoryObj = new OrderHistoryDao();
        foreach ($request['items'] as $value) {
            $orderHasItemsObj = $orderHasItemsDao->create(array('item_id' => $value, 'order_id' => $order->id));
            $orderOrderHistoryObj->addToOrderHistory(array("item_id"=>$value,'order_id' => $order->id,'pickup_date'=>$request['pickup_date'],'pickup_time'=>$request['pickup_time']));
        }
        // transsaction ends

        \Illuminate\Support\Facades\Event::fire(new OrderWasMade());
    }

    function read($id) {
        $order = Order::find($id);
        return $order;
    }

    function update($request) {
        $order = Order::find($request['id']);
        if ($order) {
            $order = $this->setProperties($order, $request);
            $order->save();
            return $order;
        }
    }

    function delete($id) {
        Order::destroy($id);
    }

    function getOrderByUserId($id) {
//        \DB::enableQueryLog();
        $order = Order::where('user_id', $id)->get();

        return $order;
    }

    function getOrderByStatus($status = "new", $formatIt = true) {

        $query = "select en.pickup_time, en.pickup_date,addr.*,addr.id as address_id,users.first_name,users.last_name,users.id as user_id,cat.name as item_name,cat.id as item_id  from   order_has_items ehi    JOIN  category cat  on  cat.id=ehi.item_id JOIN order en on en.id= ehi.order_id JOIN address addr on addr.id=en.address_id join users on addr.user_id=users.id where en.status=?";

        $enquiries = \DB::select($query, [$status]);
        if (!$formatIt) {
            return $enquiries;
        }
        $personalDetailsNotSet = true;
        $personalDetails = [];
        $returnArray = [];
        $address = [];
        $orderItems = [];
        foreach ($enquiries as $value) {
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
                $address['Pickup Date'] = $value->pickup_date;
                $address['Pickup Time'] = $value->pickup_time;
            }
            $orderItems[$value->item_id] = $value->item_name;
        }
        if (!empty($orderItems)) {
            $returnArray ['personal_details'] = $personalDetails;
            $returnArray ['address'] = $address;
            $returnArray ['order_items'] = $orderItems;
        }
        return $returnArray;
    }
    
    
    
    
    

}
