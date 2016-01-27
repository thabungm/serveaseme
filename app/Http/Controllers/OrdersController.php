<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class OrdersController extends Controller implements Crud
{
    
    
    
    function create(RequestFacade $request) {
        $ordersDao = new OrdersDao();
        $order = $ordersDao->create(RequestFacade::all());
        return $this->jsonResponse($order);

    }
    
    function read($id) {
        $ordersDao = new OrdersDao();
        $order = $ordersDao->read($id);
        return $this->jsonResponse($order);
    }

    function update(RequestFacade $request){
        $ordersDao = new OrdersDao();
        $order = $ordersDao->update(RequestFacade::all());
        return $this->jsonResponse($order);
    }
    
    
    function delete(RequestFacade $request){
        $ordersDao = new OrdersDao();
        $order = $ordersDao->delete(RequestFacade::input('id'));
        return $this->jsonResponse($order);
    }
    
    
    
}
