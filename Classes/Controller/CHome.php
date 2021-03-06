<?php

/**
 * CHome è il controller principale. si occupa di costruire la pagina grazie all'aiuto
 * degli altri controllori che vengono richiamati quando necessario.
 * 
 * @access public
 * @package Controller
 * @author Clinicard
 */
class CHome {  

    /**
     * Richiama le funzioni che costruiscono e stampano la pagina
     */
    public function start() {
        $this->buildPage();
        $this->showPage();
    }
    
    /**
     * Costruisce la struttura della pagina in base a ciò che viene
     * passao dallo switch. Se non lo switch non ritorna alcun valore 
     * assegna la pagina home
     */
    public function buildPage() {
        $content=$this->controlSwitch();
        $VHome=USingleton::getInstance('VHome');
        //!content= need to show homepage
        if(!$content){
            $content=$VHome->getHomeContent();            
        }
        
        $this->setPage($content);
        //$this->addLoginBox();
        //$VHome->assign('loginBox',NULL); //lato client
    }
    
    
    /**
     * Assegna Header,Body e Footer in base al contenuto dell'array $content
     * 
     * @param type $content array
     */
    public function setPage($content) {
        $VHome=  USingleton::getInstance("VHome");
        foreach ($content as $key => $value) {
            if($value){
                switch ($key) {
                    case "body":
                        $VHome->setBody($value);
                        break;

                    case "header":
                        $VHome->setHeader($value);
                        break;

                    case "footer":
                        $VHome->setFooter($value);
                        break;
                }
            }
        }
    }
    
    
    /**
     * Stampa la pagina una volta che è stata costruita da buildPage. Il contenuto è diverso
     * a seconda che l'utente sia un medico (o admin) oppure no
     */
    public function showPage() {
        $VHome=  USingleton::getInstance('VHome');
        $FUtente=  USingleton::getInstance('FUtente');
        $USession=  USingleton::getInstance('USession');
        if ($FUtente->isMedic($USession->get('username'))){
            $VHome->showPage(true);
        }
        else {
            $VHome->showPage(false);            
        }
    }

    /**
     * non viene più usata si può cancellare
     */
    private function addLoginBox(){
        $CLogin=USingleton::getInstance('CLogin');
        $VHome=USingleton::getInstance('VHome');
        $USession=USingleton::getInstance('USession');

        if ($CLogin->checkLoggedIn()) {
            $username=$USession->get('username');
            debug('username: '.$username);
            $VHome->setUsernameToShow($username);
            $VHome->loadLogoutButton();                
        }
        else {
            $VHome->loadLoginForm();
        }
    }

    /**
     *controlSwitch is the core function of the system. Its behavior
     *is established by the controller passed by the HTML's get method.
     *Returns False if body has not been calcolated
     * 
     * Funzione principale del programma, vi passa ogni metodo o chiamata di qualcunque controllore,
     * comprese le chiamate ajax. Il suo comportamento dipende dal comando che gli viene
     * passato dallo strato Entity
     * 
     * 
     * @return null|string[] HTML content, false if no HTML returned
     */
    public function controlSwitch() {
        $VHome=Usingleton::getInstance('VHome');

        $action=$VHome->get('control');
        switch ($action) {
            
            case 'VisitBooking':
                $CVisitBooking=  USingleton::getInstance('CVisitBooking');
                return $CVisitBooking->getContent();
                

//            case 'login':
//                $CLogin=USingleton::getInstance('CLogin');
//                $result=$CLogin->manageLogin();
//                if ( $result==false ){
//                    $message="Username o password errati";
//                    $body=$VHome->getErrorMessage($message);
//                    return array("body"  => $body);
//                }
//                else {
//                    return FALSE; // vedere bene.. secondo me ritorna html di home
//                }
                
                

//            case 'logout':
//                $CLogin=USingleton::getInstance('CLogin');
//                $CLogin->logout();
//                return FALSE; //come sopra

            case 'manageDB':
                $CPatientsDB=  USingleton::getInstance('CPatientsDB');
                $VHome=  USingleton::getInstance('VHome');
                return $VHome->makeContentArray($CPatientsDB->getBody(),$CPatientsDB->getHeader());
                //return array("header" =>$CPatientsDB->getHeader(), "body"  => $CPatientsDB->getBody());

            case 'Services':
                return $VHome->getServicesContent();

            case 'Registration':
                $CRegistration=  USingleton::getInstance('CRegistration');
                //return array("body"  => $CRegistration->newUser());
                return $VHome->makeContentArray($CRegistration->newUser(),$CRegistration->getHeader());

            case 'Contacts':
                return $VHome->getContactsContent();
                
            case 'Pictures':
                return $VHome->getPicturesContent();
                
            case 'ajaxCall':
                USingleton::getInstance('CAjaxSwitcher');
                break;
            
            default:
                return $VHome->getHomeContent();
        }
    }




}
