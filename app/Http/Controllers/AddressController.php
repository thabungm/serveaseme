<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;
use Illuminate\Http\Request as Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dao\AddressDao as AddressDao;

class AddressController extends Controller
{
    
    /**
     * 
     * @param RequestFacade $request
     * @return type
     */
    function create(RequestFacade $request) {
        $addressDao = new AddressDao();
        
        $item = $addressDao->create(RequestFacade::all());
        return $this->jsonResponse($item);
    }
    
    function read($id) {
        $addressDao = new AddressDao();
        $item = $addressDao->read($id);
        return $this->jsonResponse($item);
    }

    function update(RequestFacade $request){
        $addressDao = new AddressDao();
        $item = $addressDao->update(RequestFacade::all());
        return $this->jsonResponse($item);
    }
    
    
    function delete(RequestFacade $request){
        $addressDao = new AddressDao();
        $item = $addressDao->delete(RequestFacade::input('id'));
        return $this->jsonResponse($item);
    }
    
    
    /**
     * 
     * 
     * @param RequestFacade $request
     * @return type
     */
    function getAddressByUser($id){
        
        
        
        $addressDao = new AddressDao();
        $address = $addressDao->getAddressByUserId($id);
        return $this->jsonResponse($address);
    }
    
}
