<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;
use Illuminate\Http\Request as Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dao\ItemsDao as ItemsDao;

class ItemsController extends Controller
{
    
    
    function __construct() {
        
    }
    
    /**
     * 
     * @param RequestFacade $request
     * @return type
     */
    function create(RequestFacade $request) {
        
        $itemsDao = new ItemsDao();
        $item = $itemsDao->create(RequestFacade::all());
        return $this->jsonResponse($item);

    }
    
    function read($id) {
        $itemsDao = new ItemsDao();
        $item = $itemsDao->read($id);
        return $this->jsonResponse($item);
    }

    function update(RequestFacade $request){
        $itemsDao = new ItemsDao();
        $item = $itemsDao->update(RequestFacade::all());
        return $this->jsonResponse($item);
    }
    
    
    function delete(RequestFacade $request){
        $itemsDao = new ItemsDao();
        $item = $itemsDao->delete(RequestFacade::input('id'));
        return $this->jsonResponse($item);
    }
    
    
    /**
     * 
     * 
     * @param RequestFacade $request
     * @return type
     */
    function getItemsByCategory($categoryId){
        $itemsDao = new ItemsDao();
        $items = $itemsDao->getItemsByCategory($categoryId);
        return $this->jsonResponse($items);
    }
    
}
