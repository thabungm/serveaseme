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

    
    function getItemsByCategory($id) {
        $items = Items::where('category_id', $id)->get();
        return $items;
    }
    
    function getCategory() {
        $items = Items::whereNull("category_id")->get();
        return $items;
    }
        
    
    
    
    
    function createChildNode($childAttrb,$parentNodeId) {
        $parentNode = Items::find($parentNodeId);
        return (Items::create($childAttrb,$parentNode));
    }
    
    function getChildren($nodeId) {
        
        $node = Items::find($nodeId);
        if ($node) {
            return $node->children()->get();
        } else {
            return null;
        }
    }
    
    /**
     * 
     * 
     * @param type $request
     */
    function create($request) {
        $item = Items::create($request);
        return $item;
    }
    
    /**
     * Creating root
     * @param type $request
     */
    function createRoot($request) {
        $item = Items::create($request);
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
        $node = Items::find($id);
        $node->delete();
    }
    
    
    function moveNode($sourceId, $destinationId) {
        $sourceNode = Items::find($sourceId);
        $destinationNode = Items::find($destinationId);
        $sourceNode->appendTo($destinationNode)->save();
        return $sourceNode->hasMoved();
    }
    
    function hasChildren($nodeId) {
        $node = Items::find($nodeId);
        if (!$node) {
            return false;
        }
        if ($node->getDescendants()->count() > 0) {
            return true;
        } else {
            return false;
        }

    }
    

}
