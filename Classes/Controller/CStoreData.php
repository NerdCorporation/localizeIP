<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * Description of CStoreData
 *
 * @access public
 * @package CStoreData
 * @author Carlo
 */
class CStoreData {
    //put your code here
    
    public function saveAll() {
        $View=  USingleton::getInstance("View");
        $FStoreData=  USingleton::getInstance("FStoreData");
        
        $data=$View->get("allData");
        $FStoreData->save($data);
        
        
    }
}

?>