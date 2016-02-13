<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;
use Illuminate\Http\Request as Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dao\EnquiryDao as EnquiryDao;
//use App\Managers\EnquiryManager as EnquiryManager;

class EnquiryController extends Controller
{
    
    
    
    
    /**
     * 
     * @param RequestFacade $request
     * @return type
     */
    
    
    function create(RequestFacade $request) {
        
        $enquiryDao = new EnquiryDao();
        $enquiry = $enquiryDao->placeEnquiry(RequestFacade::all());
        return $this->jsonResponse($enquiry);

    }
    
    function read($id) {
        $enquiryDao = new EnquiryDao();
        $enquiry = $enquiryDao->read($id);
        return $this->jsonResponse($enquiry);
    }

    function update(RequestFacade $request){
        $enquiryDao = new EnquiryDao();
        $enquiry = $enquiryDao->update(RequestFacade::all());
        return $this->jsonResponse($enquiry);
    }
    
    
    function delete(RequestFacade $request){
        $enquiryDao = new EnquiryDao();
        $enquiry = $enquiryDao->delete(RequestFacade::input('id'));
        return $this->jsonResponse($enquiry);
    }
    
    
    /**
     * 
     * 
     * @param RequestFacade $request
     * @return type
     */
    function getEnquiryByCategory($categoryId){
        $enquiryDao = new EnquiryDao();
        $enquiry = $enquiryDao->getEnquiryByCategory($categoryId);
        return $this->jsonResponse($enquiry);
    }
    
    
    function getCategory(RequestFacade $request){
        $enquiryDao = new EnquiryDao();
        $enquiry = $enquiryDao->getCategory();
        return $this->jsonResponse($enquiry);
    }
    
    function getItemChildren(RequestFacade $request) {
        $enquiryManager = new EnquiryManager();
        $path = RequestFacade::all()['path'];
        $children = $enquiryManager->getItemChildren($path);
        return $this->jsonResponse($children);
    }
    
}
