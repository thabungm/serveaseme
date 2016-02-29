<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;
use Illuminate\Http\Request as Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dao\ItemsDao as ItemsDao;
use App\Dao\OrdersDao as ordersDao;

class AdminController extends Controller {

    //  Item
    // create item child
    function createChild(RequestFacade $request) {
        $req = RequestFacade::all();
        $itemsDao = new ItemsDao();
//        $childAttrib['name'] = $req['name'];
        return $this->jsonResponse($itemsDao->createChildNode($req, $req['parent_id']));
    }
    
    function updateItem(RequestFacade $request) {
        $req = RequestFacade::all();
        $itemsDao = new ItemsDao();
        return $this->jsonResponse($itemsDao->update($req));
    }

    // update item
    // deactivate item
    // remove item
    // 
    //  Enquiry
    // get enquiry
    // get all enquiry
    // update enquiry

    function getOrderHistory(RequestFacade $request) {
        $ordersDao = new OrdersDao();
        
        return $this->jsonResponse($ordersDao->getOrderHistoryAdmin(RequestFacade::all()));
//    return 
    }
    function getOrderDetails($id) {
        $ordersDao = new OrdersDao();
        
        return $this->jsonResponse($ordersDao->getOrderDetails($id));
//    return 
    }

}
