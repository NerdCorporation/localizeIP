<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * Strato foundation del Calendario
 *
 * @access public
 * @package Foundation
 * @author Clinicard
 */
class FCalendar extends FDatabase {
    
    /**
     * Salva l'evento passato senza verificare la concomitanza con altri eventi.
     * Solo un medico dovrebbe usare questa funzione
     * 
     * @param string $CF codice fiscale
     * @param date $dataInizio data inizio
     * @param string $eventID the id evento
     * @param string $titolo titolo
     * @param date $dataFine data fine
     * @return string errore
     */
    public function forceSaveEvent($CF,$dataInizio,$eventID,$titolo, $dataFine) {
        $error=false;
        $dataFine=new DateTime($dataFine);
        $dataFine=$dataFine->modify("-1 seconds");
        $dataFine=$dataFine->format("Y-m-d\TH:i:s");
        
        //insert Event data to the db
        $query1="INSERT INTO `calendario` (`CodiceFiscalePrenotazione`, `start`, `id`, `title`, `end`)";
        $query2="VALUES ('$CF','$dataInizio','$eventID','$titolo', '$dataFine')";
        $insertEvent=$query1." ".$query2;
        $this->query($insertEvent);
        if ($this->error){$error="Si è verificato un errore, si prega di riprovare: ".$this->error;}

        
     
        return $error;
    }
    
    /**
     * Saves an event if it doesn't overlap
     * 
     * @param type $CF
     * @param type $dataInizio
     * @param type $eventID
     * @param type $titolo
     * @param type $dataFine
     * @return string
     */
    public function patientSaveEvent($CF,$dataInizio,$eventID,$titolo, $dataFine) {
        $error=false;
        $dataFine=new DateTime($dataFine);
        $dataFine=$dataFine->modify("-1 seconds");
        $dataFine=$dataFine->format("Y-m-d\TH:i:s");

        
        //check if it was possible to add new event
        $queryCheckAvaiableSlot="SELECT * FROM `calendario` WHERE `start` between '$dataInizio' and '$dataFine' OR `end` between '$dataInizio' and '$dataFine' OR '$dataInizio' between `start` and `end`";
        $this->query($queryCheckAvaiableSlot);
        
        
        //if the affected rows are more than 0 (TRUE), there is another event yet
        if($this->affected_rows){
            $error="Purtroppo un altro utente si è prenotato nell'ora selezionata. Si prega di scegliere un orario diverso";
        }
        else{
            //insert Event data to the db
            $query1="INSERT INTO `calendario` (`CodiceFiscalePrenotazione`, `start`, `id`, `title`, `end`)";
            $query2="VALUES ('$CF','$dataInizio','$eventID','$titolo', '$dataFine')";
            $insertEvent=$query1." ".$query2;
            $this->query($insertEvent);
            if ($this->error && ! $error){$error="Si è verificato un errore, si prega di riprovare: ".$this->error;}
        }
        
        //now i need to check if noone entered another visit at the same time
        $this->query($queryCheckAvaiableSlot);
        if(!$this->affected_rows==1){//deny save and restore db
            $queryDelete="DELETE FROM `calendario` WHERE `id` = $eventID";
            $this->query($queryDelete);
            $error="Siamo spiacenti ma la data selezionata non è più disponibile, provare a selezionarne un altra";
            
        }
        
     
        return $error;
    }
    
    /**
     * Ritorna tutti gli eventi tra due date. Solo il medico dovrebbe accedere
     * a questa funzione
     * 
     * @param date $start
     * @param date $end
     * @return array
     */
    public function getAllEvents($start, $end) {
        
        $query= "SELECT * FROM `calendario`";// WHERE `start` between '$start' and '$end' ";
       
        $result=  $this->queryAssociativeArray($query);
        return $result;
        
    }
    
    /**
     * Restituisce tutti gli eventi che riguardano l'utente loggato. Utilizza il
     * codice fiscale per stabilire la proprietà degli eventi
     * 
     * @param date $start
     * @param date $end
     * @param string $cf
     * @return array
     */
    public function getMyEvents($start, $end, $cf) {
        
        $query= "SELECT * FROM `calendario` WHERE `CodiceFiscalePrenotazione`='$cf' AND `start` between '$start' and '$end' ";
       
        $result=  $this->queryAssociativeArray($query);
        return $result;
        
    }
    
    /**
     * Restituisce tutti i placeholders (eventi costituiti solo dalla date di inizio e fine)
     * 
     * @param date $start
     * @param date $end
     * @param string $cf
     * @return array
     */
    public function getMyPlaceholders($start,$end,$cf){
        $query= "SELECT `start`,`end` FROM `calendario` WHERE `start` between '$start' and '$end' AND `CodiceFiscalePrenotazione` != '$cf' ";
        
        $result= $this->queryAssociativeArray($query);
        return $result;
    }
    
    /**
     * Elimina un evento se isMedic è vera, altrimenti controlla prima se l'evento che si sta tentando di
     * rimuovere appartiene all'utente loggato
     * 
     * @param int $id
     * @param bool $isMedic
     * @param string $cf
     * @return array
     */
    public function deleteEvent($id,$isMedic,$cf) {
        if($isMedic){
            $query="DELETE FROM `calendario` WHERE `id` = '$id'";
            
        }else{
            $query="DELETE FROM `calendario` WHERE `id` = '$id' AND `CodiceFiscalePrenotazione`='$cf'";
            
        }
        $this->query($query);
        return $this->error;
        
    }
    
}

?>