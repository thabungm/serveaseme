<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;
use Illuminate\Http\Request as Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dao\OrdersDao as OrdersDao;
//use App\Managers\OrderManager as OrderManager;

class OrdersController extends Controller
{
    
    
    
    
    /**
     * 
     * @param RequestFacade $request
     * @return type
     */
    
    
    function create(RequestFacade $request) {
        
        $orderDao = new OrdersDao();
        $inputArray = RequestFacade::all();
        $user = $this->getLoggedInUser();
        $inputArray['user_id'] = $user->id;
        $order = $orderDao->placeOrder($inputArray);
        return $this->jsonResponse($order);

    }
    
    function read($id) {
        $orderDao = new OrdersDao();
        $order = $orderDao->read($id);
        return $this->jsonResponse($order);
    }

    function update(RequestFacade $request){
        $orderDao = new OrdersDao();
        $order = $orderDao->update(RequestFacade::all());
        return $this->jsonResponse($order);
    }
    
    
    function delete(RequestFacade $request){
        $orderDao = new OrdersDao();
        $order = $orderDao->delete(RequestFacade::input('id'));
        return $this->jsonResponse($order);
    }
    
    
    
    
    function getOrderByUser($userId) {
        
        
        
    }
    
    
}
