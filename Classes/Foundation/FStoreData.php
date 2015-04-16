<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * Description of FStoreData
 *
 * @access public
 * @package FStoreData
 * @author Carlo
 */
class FStoreData extends FDatabase {
    //put your code here
    public function save($data) {
        $giorno=date('l jS \of F Y h:i:s A');
        
        $query1="INSERT INTO `dati` (`datiutente`, `timestamp`)";
        $query2="VALUES ('$data','$giorno')";
        $saveData=$query1." ".$query2;
        $this->query($saveData);
        
    }
}

?>