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

    public function formatDateSave($date) {
        $explode = explode("/", $date);
        return $explode[2] . "-" . $explode[1] . "-" . $explode[0];
        
    }

    
    
    
    public function setDefaultCreateParam($object) {
        $object->setUpdatedAt(null);
        $object->setCreatedAt(null);
        return $object;
        
        
    }
}
