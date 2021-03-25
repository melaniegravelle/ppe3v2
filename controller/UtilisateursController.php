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
        $data = [   'listUtilisateurs'=>$listUtilisateurs, 
                    'isConnected'=>$_SESSION['isConnected']];
        
        $this->render( 'listUtilisateurs', $data );
    }

    public function affUtilisateurAction()
    {
        $affUtilisateur = $this->utilisateurManager->getUtilisateur($_GET['id']);
        $data = [   'utilisateur'=>$affUtilisateur,
                    'isConnected'=>$_SESSION['isConnected']];
        $this->render( 'affUtilisateur', $data );
    }

    public function modifUtilisateurAction()
    {
        $modifUtilisateur = $this->utilisateurManager->getUtilisateur($_REQUEST['id']);
        $data = [   'utilisateur'=>$modifUtilisateur,
                    'isConnected'=>$_SESSION['isConnected']];
        $this->render( 'modifUtilisateur', $data );
    }

    public function supprUtilisateurAction()
    {
        if ( isset( $_REQUEST['id'] ) ) {
            $this->utilisateurManager->supprUtilisateur($_REQUEST['id']);
        }
        $this->listUtilisateursAction();
    }

    public function createUtilisateurAction()
    {
        
        $data_create_utilisateur = ['isConnected'=>$_SESSION['isConnected']];
        if( isset( $_REQUEST['ajouter'] ) ) {
            $dataDb = [
                'nom'               => $_REQUEST['nom'],
                'prenom'            => $_REQUEST['prenom'],
                'login'             => $_REQUEST['login'],
                'mot_de_passe'      => $_REQUEST['mot_de_passe'],
                'statut'            => $_REQUEST['statut']
            ];
            $newUtilisateur = new Utilisateurs( $dataDb );

            if($this->utilisateurManager->createUtilisateur( $newUtilisateur ) ) 
            {
                $this->listUtilisateursAction();
            } 
        }
        elseif(isset( $_REQUEST['retour'] ))
        {
            $this->listUtilisateursAction();
        }
        else 
        {
            $data_create_utilisateur = [
                'utilisateur'    => false,
                'errorMess'      => 'An mistery error occured',
                'isConnected'=>$_SESSION['isConnected']
            ];
            $this->render( 'createUtilisateur', $data_create_utilisateur );
        }
        
    }


    public function verifUtilisateurAction()
    {   

        if(isset($_REQUEST['connexion']) && !empty($_REQUEST['login']) && !empty($_REQUEST['mot_de_passe']))
        {
            $login = $_REQUEST['login'];
            $mot_de_passe = $_REQUEST['mot_de_passe'];
            $utilisateur = new UtilisateursManager();
            if($utilisateur->verifUtilisateur($login, $mot_de_passe))
            {
                
                $_SESSION['isConnected'] = true;
                $data = ['isConnected'=>$_SESSION['isConnected']];
                $this->render( 'index', $data );
            
            }
            else 
            {
                $_SESSION['isConnected'] = false;
                $data = [];
        
                $this->render( 'connexion', $data );
            }
        }
    }
}
