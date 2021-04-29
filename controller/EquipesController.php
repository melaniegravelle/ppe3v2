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

    public function affEquipeAction()
    {
        $affEquipe = $this->equipesManager->getEquipe($_GET['id']);
        $data = [   'equipe'=>$affEquipe,
                    'isConnected'=>$_SESSION['isConnected'],
                    'isAdmin'    => $_SESSION['isAdmin']];
        $this->render( 'affEquipe', $data );
    }

    public function createEquipeAction()
    {
        if( isset( $_REQUEST['ajouter'] ) ) {
            $data_create_equipe = ['isConnected'=>$_SESSION['isConnected']];
            $dataDb = [
                'nom_equipe'        => $_REQUEST['nom'],
                'nom_entraineur'    => $_REQUEST['prenom'],
                'logo'              => $_REQUEST['logo'],
                'info'              => $_REQUEST['info'],
            ];
            $newEquipe = new Equipes( $dataDb );

            if($this->equipeManager->createEquipe( $newEquipe ) ) 
            {
                $this->listEquipesAction();
            } 
        }
        elseif(isset( $_REQUEST['retour'] ))
        {
            $this->listEquipesAction();
        }
        else 
        {
            $data_create_equipe = [
                'equipe'    => false,
                'errorMess'      => 'An mistery error occured',
                'isConnected'    =>$_SESSION['isConnected'],
                'isAdmin'       => $_SESSION['isAdmin']
            ];
            $this->render( 'createEquipe', $data_create_equipe );
        }
        
    }
}