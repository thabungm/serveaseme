<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Dao\OrdersDao as OrdersDao;

use App\Http\Controllers\Controller;
class OrdersController extends Controller 
{
    
    
    
    function create(RequestFacade $request) {
        $ordersDao = new OrdersDao();
        $order = $ordersDao->placeOrder(RequestFacade::all());
        return $this->jsonResponse($order);

    }
    
    function read($id) {
        $ordersDao = new OrdersDao();
        $order = $ordersDao->read($id);
        return $this->jsonResponse($order);
    }

    function update($request){
        $ordersDao = new OrdersDao();
        $order = $ordersDao->update(RequestFacade::all());
        return $this->jsonResponse($order);
    }
    
    
    function delete($request){
        $ordersDao = new OrdersDao();
        $order = $ordersDao->delete(RequestFacade::input('id'));
        return $this->jsonResponse($order);
    }
    
    
    
    
    
}
