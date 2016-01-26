<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;
use Illuminate\Http\Request as Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dao\UsersDao as UsersDao;

class UsersController extends Controller
{
    
    
    
    
    
    /**
     * 
     * @param RequestFacade $request
     * @return type
     */
    function create(RequestFacade $request) {
        

    }
    /**
     * 
     * @param RequestFacade $request
     * @return type
     */
    function signup(RequestFacade $request) {
        
        $usersDao = new UsersDao();
        $user = $usersDao->create(RequestFacade::all());
        return $this->jsonResponse($user);

    }
    
    function read($id) {
        $usersDao = new UsersDao();
        $user = $usersDao->read($id);
        return $this->jsonResponse($user);
    }

    function update(RequestFacade $request){
        $usersDao = new UsersDao();
        $user = $usersDao->update(RequestFacade::all());
        return $this->jsonResponse($user);
    }
    
    
    function delete(RequestFacade $request){
        $usersDao = new UsersDao();
        $user = $usersDao->delete(RequestFacade::input('id'));
        return $this->jsonResponse($user);
    }
    
    
    
    
}
