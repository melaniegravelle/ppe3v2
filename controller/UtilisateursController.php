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

    public function modifUtilisateurAction()
    {
        $modifUtilisateur = $this->utilisateurManager->getUtilisateur($_GET['id']);
        $data = ['utilisateur'=>$modifUtilisateur];
        $this->render( 'modifUtilisateur', $data );
    }

    public function createUtilisateurAction()
    {
        if($_POST['modification'])
        {
            $data_create_utilisateur = [];
            if( isset( $_REQUEST['identifiant'] ) ) {
                $dataDb = [
                    'nom'               => $_REQUEST['nom'],
                    'prenom'            => $_REQUEST['prenom'],
                    'identifiant'       => $_REQUEST['identifiant'],
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
        elseif ($_POST['retour'])
        {

        }
    }

    public function supprUtilisateur()
    {

    }

}