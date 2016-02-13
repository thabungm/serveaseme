<?php
namespace App\Managers;
use App\Dao\ItemsDao as ItemsDao;
class ItemsManager {

    function getItemChildren($path = "/") {
        /**
         * @todo clean this shit
         */
        $itemsDao = new ItemsDao();
        $items = $itemsDao->getItemsByPath($path);
        $itemArray = array();
        
        foreach ($items as $value) {
            if (isset($itemArray[$value->path])) {
                
                $itemArray[$value->path][] = $value;
            } else {
                $itemArray[$value->path] = array();
            }
            
        }
        
        return $itemArray;
    }

}
