<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;
use Illuminate\Http\Request as Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dao\ItemsDao as ItemsDao;
use App\Managers\ItemsManager as ItemsManager;

class ItemsController extends Controller
{
    
    private $itemsDao;
    function __construct() {
        parent::__construct();
        $this->itemsDao = new ItemsDao();
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
    /**
     * 
     * @param RequestFacade $request
     * @return type
     */
    function createRoot(RequestFacade $request) {
        
        $itemsDao = new ItemsDao();
        $item = $itemsDao->createRoot(RequestFacade::all());
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
    
    
    function getCategory(RequestFacade $request){
        $itemsDao = new ItemsDao();
        $items = $itemsDao->getCategory();
        return $this->jsonResponse($items);
    }
    
    function getItemChildren(RequestFacade $request) {
        $itemsManager = new ItemsManager();
        $path = RequestFacade::all()['path'];
        $children = $itemsManager->getItemChildren($path);
        return $this->jsonResponse($children);
    }
    
    
    
    function getChildren($parentId) {
        return $this->jsonResponse($this->itemsDao->getChildren($parentId));
    }
    
    function hasChildren($nodeId) {
        return $this->jsonResponse($this->itemsDao->hasChildren($nodeId));
    }
    
    
    
}
