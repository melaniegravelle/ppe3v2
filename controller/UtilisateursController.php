<?php
namespace controller;

use model\Utilisateurs;
use model\UtilisateursManager;

class UtilisateursController extends Controller
{
    protected $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateursManager();
        parent::__construct();
    }


    public function defaultAction()
    {

    }

    public function listUtilisateursAction()
    {
        $listUtilistaurs = $this->utilisateurManager->getAllUtilisateurs();
        $data = [ 'listUtilisateurs'=>$listUtilistaurs ];
        $this->render( 'listUtilisateurs', $data );
    }

    public function createUtilisateurAction()
    {
        
    }
}