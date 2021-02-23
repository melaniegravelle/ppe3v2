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
        $listUtilisateurs = $this->utilisateurManager->getAllUtilisateurs();
        $data = [ 'listUtilisateurs'=>$listUtilisateurs ];
        $this->render( 'listUtilisateurs', $data );
    }

    public function affUtilisateurAction()
    {
        $affUtilisateur = $this->utilisateurManager->getUtilisateur($_GET['id']);
        $data = ['utilisateur'=>$affUtilisateur];
        $this->render( 'affUtilisateur', $data );
    }


}