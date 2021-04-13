<?php
namespace controller;

use model\Resultats;
use model\ResultatsManager;

class ResultatsController extends Controller
{
    protected $resultatsManager;

    public function __construct()
    {
        $this->resultatsManager = new ResultatsManager();
        parent::__construct();
    }

    public function defaultAction()
    {

    }

    public function listResultatsAction()
    {
        $listResultats = $this->resultatsManager->getAllResultats();
        $data = [   'listResultats'   =>$listResultats, 
                    'isConnected'     =>$_SESSION['isConnected'],
                    'isAdmin'         => $_SESSION['isAdmin']];
        
        $this->render( 'listResultats', $data );
    }
}