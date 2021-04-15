<?php
namespace controller;

use model\Equipes;
use model\EquipesManager;

class EquipesController extends Controller
{
    protected $equipesManager;

    public function __construct()
    {
        $this->equipesManager = new EquipesManager();
        parent::__construct();
    }

    public function defaultAction()
    {

    }

    public function listEquipesAction()
    {
        $listEquipes = $this->equipesManager->getAllEquipes();
        $data = [   'listEquipes'   =>$listEquipes, 
                    'isConnected'     =>$_SESSION['isConnected'],
                    'isAdmin'         => $_SESSION['isAdmin']];
        
        $this->render( 'listEquipes', $data );
    }
}