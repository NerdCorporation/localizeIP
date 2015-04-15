<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * VVisitBooking è lo strato view della gestione della prenotazione visita
 *
 * @access public
 * @package View
 * @author Clinicard
 */
class VVisitBooking extends View {
    /**
     * restituisce il body
     * 
     * @return string/html
     */
    public function getBody(){
        $body= $this->fetch("body_visitBooking.tpl");
        return $body;
    }
    
    /**
     * restituisce l'header
     * 
     * @return type string/html
     */
    public function getHeader() {
        $header= $this->fetch("./headers/header_visitBooking.tpl");
        return $header;
        
    }
    
    /**
     * restituisce la content array
     * 
     * @return array
     */
    public function getContent() {
        $body=  $this->getBody();
        $header=  $this->getHeader();
        $content=  $this->makeContentArray($body,$header);
        return $content;
        
    }
    
    /**
     * imposta l'header del medico
     */
    public function setMedicHeader() {
        $this->assign('isMedic',1);
    }
    
    /**
     * imposta l'header dell'user
     */
    public function setUserHeader() {
        $this->assign('isMedic',0);
    }
    
}

?>