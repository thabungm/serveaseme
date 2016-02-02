<?php
namespace App\Dao;
/**
 * Description of CommonDao
 *
 * @author thabung
 */
class CommonDao {
    public function setDefaultUpdateParam($object) {
        
        
    }
    
    
    public function setDefaultCreateParam($object) {
        $object->setUpdatedAt(null);
        $object->setCreatedAt(null);
        return $object;
        
        
    }
}
