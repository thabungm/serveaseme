<?php
namespace App\Dao;
use App\Models\Items as Items;
use App\Common\Crud as Crud;
use App\Dao\CommonDao as CommonDao;
use App\Dao\DaoInterface as DaoInterface;

class ItemsDao extends CommonDao implements  DaoInterface {

    function __construct() {
        
    }

    function setProperties($object, $inputArray) {
        if (isset($inputArray['name'])) {
            $object->name = $inputArray['name'];
        }
        if (isset($inputArray['category_id'])) {
            $object->category_id = $inputArray['category_id'];
        }
        if (isset($inputArray['price'])) {
            $object->price = $inputArray['price'];
        }
        if (isset($inputArray['special_price'])) {
            $object->special_price = $inputArray['special_price'];
        }
        return $object;
    }

    /**
     * 
     * 
     * @param type $request
     */
    function create($request) {
        $item = new Items();
        $item = $this->setProperties($item, $request);
        $item->save();
        return $item;
    }

    function read($id) {
        $item = Items::find($id);
        return $item;
    }

    function update($request) {
        $item = Items::find($request['id']);
        if ($item) {
            $item = $this->setProperties($item, $request);
            $item->save();
            return $item;
        }
    }

    function delete($id) {
        Items::destroy($id);
    }
    

    function getItemsByCategory($id) {

        $items = Items::where('category_id', $id)->get();
        return $items;
    }

}
