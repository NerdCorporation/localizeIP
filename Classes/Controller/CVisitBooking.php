<?php


/*
 * File creato da Carlo Centofanti
 */

/**
 * CVisitBooking è il controllore deputato a gestire le funzioni del calendario
 * e prenotazione visita.
 *
 * @access public
 * @package Controller
 * @author Clinicard
 */
class CVisitBooking {
    
    /**
     * Restituisce l'array Content 
     * 
     * @return array content Array
     */
    public function getContent() {
        $error=false;
        $VVisitBooking=  USingleton::getInstance("VVisitBooking");
        $CLogin=  USingleton::getInstance("CLogin");
        $VVisitBooking->setUserHeader();//must set to avoid smarty crash
        if($CLogin->isMedic()){//set medic prviledges
            $VVisitBooking->setMedicHeader();
        }elseif(!$CLogin->checkLoggedIn()){
            $message="Per accedere a quest'area devi prima effettuare il Login";
            $error= $VVisitBooking->getErrorMessage($message);
        }
        if($error){
            $content=$VVisitBooking->makeContentArray($error);
        }else $content=$VVisitBooking->getContent();
        
        return $content;
    }
    
    /**
     * Gestisce la relativa chiamata ajax salvando l'evento passato da ajax.
     * stampa una stringa json in caso di errore
     */
    public function saveEvent() {
        $VVisitBooking=  USingleton::getInstance("VVisitBooking");
        $FCalendar=  USingleton::getInstance("FCalendar");
        $FUtente=  USingleton::getInstance("FUtente");
        $CLogin=  USingleton::getInstance("CLogin");
        
        
        
        $user=$CLogin->getMyUsername();
        $userdata=$FUtente->getAllUtenteDataFromUsername($user);
        $dataInizio=$VVisitBooking->get("dataInizio");
        $eventID=$VVisitBooking->get("eventID");
        $titolo=$VVisitBooking->get("titolo");
        $dataFine=$VVisitBooking->get("dataFine");
        
        if($CLogin->isMedic()){
            $CF=$VVisitBooking->get("cf");
            $error=$FCalendar->forceSaveEvent($CF, $dataInizio, $eventID, $titolo, $dataFine);
            
        }elseif($CLogin->checkLoggedIn()){
            $CF=$userdata["Codice Fiscale"];
            $error=$FCalendar->patientSaveEvent($CF, $dataInizio, $eventID, $titolo, $dataFine);
        }
        
        
        echo $error;
        exit();
    }
    
    /**
     * Visualizza una stringa json contenente gli eventi visibili dall'utente che
     * li richiede(i medici vedono tutti gli eventi)
     */
    public function getMyEvents() {
        $FCalendar=  USingleton::getInstance("FCalendar");
        $VVisitBooking=  USingleton::getInstance("VVisitBooking");
        $CLogin=  USingleton::getInstance("CLogin");
        if($CLogin->isMedic()){//medico
        
            $firstDate=$VVisitBooking->get("start");
            $lastDate=$VVisitBooking->get("end");

            $eventi=$FCalendar->getAllEvents($firstDate, $lastDate);

            echo json_encode($eventi);
            exit();
        }
        elseif($CLogin->checkLoggedIn()){//utente normale
            $FUtente=  USingleton::getInstance("FUtente");
            
            $firstDate=$VVisitBooking->get("start");
            $lastDate=$VVisitBooking->get("end");
            $user=$CLogin->getMyUsername();
            $userdata=$FUtente->getAllUtenteDataFromUsername($user);
            $cf=$userdata["Codice Fiscale"];
            
            
            $eventi=$FCalendar->getMyEvents($firstDate, $lastDate,$cf);
            

            echo json_encode($eventi);
            exit();
        }
    }
    
    /**
     * Visualizza una stringa json fatta di eventi contenenti solo data inizio e 
     * data di fine per permettere all'utente di vedere quando è possibile prenotarsi
     */
    public function getMyPlaceHolders() {
        $VVisitBooking=  USingleton::getInstance("VVisitBooking");
        $CLogin=  USingleton::getInstance("CLogin");
        $FUtente=  USingleton::getInstance("FUtente");
        $FCalendar=  USingleton::getInstance("FCalendar");
        
        $firstDate=$VVisitBooking->get("start");
        $lastDate=$VVisitBooking->get("end");
        $user=$CLogin->getMyUsername();
        $userdata=$FUtente->getAllUtenteDataFromUsername($user);
        $cf=$userdata["Codice Fiscale"];

        $eventi=$FCalendar->getMyPlaceholders($firstDate, $lastDate,$cf);
        echo json_encode($eventi);
        exit();
    }
    
    /**
     * Visualizza i dati dell'utente in formato json
     */
    public function getUserData() {
        $CLogin=  USingleton::getInstance("CLogin");
        $FUtente=  USingleton::getInstance("FUtente");
        $username=$CLogin->getMyUsername();
        $userdata=$FUtente->getAllUtenteDataFromUsername($username);
        echo json_encode($userdata);
        exit();
        
    }
    
    /**
     * Elimina un utente e in caso di errore visualizza la relativa stringa in formato json
     */
    public function deleteEvent() {
        $VVisitBooking=  USingleton::getInstance("VVisitBooking");
        $FCalendar=  USingleton::getInstance("FCalendar");
        $CLogin=  USingleton::getInstance("CLogin");
        $FUtente=  USingleton::getInstance("FUtente");
        
        $user=$CLogin->getMyUsername();
        $isMedic=$CLogin->isMedic();
        $userdata=$FUtente->getAllUtenteDataFromUsername($user);
        $cf=$userdata["Codice Fiscale"];
        
        $id=$VVisitBooking->get("idEvento");
        
        
        $error=$FCalendar->deleteEvent($id,$isMedic,$cf);
        
        echo json_encode($error);
        exit();
    }
    
    
    
    
}