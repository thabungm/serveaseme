<?php
namespace App\Dao;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
