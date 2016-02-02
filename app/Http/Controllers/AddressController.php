<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Common\Crud as Crud;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Models\Address as Address;
class AddressController extends Controller implements Crud
{
    
    function create(Request $request) {
        echo "FSDF";
        $request = $request->input('body');
        $account = array();
        $account['z'] = 'thabung' ;
        return Response::json($request);
        
        
    }
    
    function read() {
        
        
    }
    
    function update() {
        
        
    }
    function delete() {
        
        
    }
    
}
