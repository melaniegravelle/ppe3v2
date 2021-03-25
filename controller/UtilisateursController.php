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

    public function supprUtilisateurAction()
    {
        $supprUtilisateur = $this->utilisateurManager->supprUtilisateur($_GET['id']);
        $data = ['utilisateur'=>$supprUtilisateur];
        $this->render( 'supprUtilisateur', $data );
    }

    public function modifUtilisateurAction()
    {
        $modifUtilisateur = $this->utilisateurManager->getUtilisateur($_GET['id']);
        $data = ['utilisateur'=>$modifUtilisateur];
        $this->render( 'modifUtilisateur', $data );
    }

    public function createUtilisateurAction()
    {

        $data_create_utilisateur = [];
        if( isset( $_REQUEST['login'] ) ) {
            $dataDb = [
                'nom'               => $_REQUEST['nom'],
                'prenom'            => $_REQUEST['prenom'],
                'login'       => $_REQUEST['login'],
                'mot_de_passe'      => $_REQUEST['mot_de_passe'],
                // 'pays'              => $_REQUEST['pays'],
                // 'ville'             => $_REQUEST['ville'],
                // 'code_postal'       => $_REQUEST['code_postal']
            ];
            $newUtilisateur = new Utilisateurs( $dataDb );

            if( $id = $this->utilisateurManager->createUtilisateur( $newUtilisateur ) ) {
                $newUtilisateur->setId( $id );
                $data_create_utilisateur = [
                    'id'             => $id,
                    'utilisateur'    => $dataDb
                ];
            } else {
                $data_create_utilisateur = [
                    'utilisateur'    => false,
                    'errorMess'      => 'An mistery error occured'
                ];
            }
        }
        $this->render( 'createUtilisateur', $data_create_utilisateur );
    }

    public function supprUtilisateur()
    {

    }

public function verifUtilisateurAction()
    {
        if(isset($_REQUEST['connexion']) && empty($_REQUEST['login']) && empty($_REQUEST['mot_de_passe']))
        {

        }
    }
}
