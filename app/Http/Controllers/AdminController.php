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
    
    function isAdmin($user) {
        if (!$user) {
            return false;
        }
        if ($user->role == "admin") {
            return true;
        } else {
            return false;
        }

    }
    function __construct() {
        parent::__construct();
        if (!$this->isAdmin($this->getLoggedInUser())) {
            throw new \Exception("Not allowed, only admin has access",401);

        }
    }

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
    }

    function getOrderDetails($id) {
        $ordersDao = new OrdersDao();
        return $this->jsonResponse($ordersDao->getOrderDetails($id));

    }

    function updateOrder() {
        $ordersDao = new OrdersDao();
        return $ordersDao->updateOrder(RequestFacade::all());
    }


    function getAddressByOrder($orderId) {
        $ordersDao = new OrdersDao();
        $req = RequestFacade::all();
        return $this->jsonResponse($ordersDao->getAddressByOrder($orderId));
    }
}
