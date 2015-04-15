<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * Strato foundation di login
 *
 * @access public
 * @package Foundation
 * @author Clinicard
 */
class FLogin extends FDatabase {
    
    /**
     * Controlla che la coppia username+password inseriti dall'utente in fase di 
     * autenticazione corrisponda a una coppia di valori contenuta nel database, in tal caso 
     * restituisce true.
     * 
     * @param string $user username
     * @param string $pass password
     * @return boolean
     */
    public function checkUser($user,$pass){
        $query="SELECT * FROM `utenti` WHERE `Username`='".$user."'";
        $res=$this->query($query);

        $result=$res->fetch_assoc();
        if ($result==NULL) {return false;}
        else {
            if ($pass==$result['Password']) {return true;}
            else {return false;}
        }

    }
}

?>