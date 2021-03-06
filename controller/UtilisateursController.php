<?php
namespace controller;

use model\Utilisateurs;
use model\UtilisateursManager;
use classes\sodiumSecure;

class UtilisateursController extends Controller
{
    protected $utilisateurManager;
    protected $sodiumSecure;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateursManager();

        $this->sodiumSecure = new SodiumSecure();
        parent::__construct();
    }


    public function defaultAction()
    {

    }

    public function listUtilisateursAction()
    {
        $listUtilisateurs = $this->utilisateurManager->getAllUtilisateurs();
        $data = [   'listUtilisateurs'=>$listUtilisateurs, 
                    'isConnected'     =>$_SESSION['isConnected'],
                    'isAdmin'         => $_SESSION['isAdmin']];
        
        $this->render( 'listUtilisateurs', $data );
    }

    public function affUtilisateurAction()
    {
        $affUtilisateur = $this->utilisateurManager->getUtilisateur($_GET['id']);
        $data = [   'utilisateur'=>$affUtilisateur,
                    'isConnected'=>$_SESSION['isConnected'],
                    'isAdmin'    => $_SESSION['isAdmin']];
        $this->render( 'affUtilisateur', $data );
    }

    public function modifUtilisateurAction()
    {
        if(isset( $_REQUEST['retour'] ))
        {
            $this->listUtilisateursAction();
        }
        elseif( isset( $_REQUEST['modifier'] ))
        {
            $modifUtilisateur = $this->utilisateurManager->getUtilisateur($_REQUEST['id']);

            $modifUtil = new Utilisateurs( $modifUtilisateur );

            $oldPass = $modifUtil->getMotDePasse();

            if( $oldPass !== $_REQUEST['mot_de_passe'] ) {
                $mot_de_passe_hache = $this->sodiumSecure->hashWord($_REQUEST['mot_de_passe']);
            } else {
                $mot_de_passe_hache = $_REQUEST['mot_de_passe'];
            }    
            $dataDb = [
                'nom'               => $_REQUEST['nom'],
                'prenom'            => $_REQUEST['prenom'],
                'login'             => $_REQUEST['login'],
                'motDePasse'        => $mot_de_passe_hache
            ];   

          // var_dump( $dataDb );die; 
            $modifUtil->setNom( $dataDb['nom'] );
            $modifUtil->setPrenom( $dataDb['prenom'] );
            $modifUtil->setLogin( $dataDb['login'] );
            $modifUtil->setMotDePasse( $dataDb['motDePasse'] );

            if( $this->utilisateurManager->modifUtilisateur( $modifUtil ) ) {

                $data = [   'utilisateur'=>$modifUtil, 
                            'isConnected'=>$_SESSION['isConnected'],
                            'isAdmin'    => $_SESSION['isAdmin']
                        ];
            } else {
                $data = [
                    'message' => 'Erreur : La modification a échoué'
                ];
            }
            $this->listUtilisateursAction();

        } else {
            $modifUtilisateur = $this->utilisateurManager->getUtilisateur($_REQUEST['id']);
            $data = [   'utilisateur'=>$modifUtilisateur,
                        'isConnected'=>$_SESSION['isConnected'],
                        'isAdmin'    => $_SESSION['isAdmin']];
            $this->render( 'modifUtilisateur', $data );  

        }
       
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

        if( isset( $_REQUEST['ajouter'] ) ) {
            $mot_de_passe_hache = $this->sodiumSecure->hashWord($_REQUEST['mot_de_passe']);
            $data_create_utilisateur = ['isConnected'=>$_SESSION['isConnected']];
            $dataDb = [
                'nom'               => $_REQUEST['nom'],
                'prenom'            => $_REQUEST['prenom'],
                'login'             => $_REQUEST['login'],
                'motDePasse'        => $mot_de_passe_hache,
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
                'isConnected'    =>$_SESSION['isConnected'],
                'isAdmin'       => $_SESSION['isAdmin']
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
            if( $user = $utilisateur->getUserByLogin($login))
            {
                $pass = $user['mot_de_passe'];
                if( $this->sodiumSecure->verifWord( $pass, $mot_de_passe ) ) {
                    //var_dump( $user );
                    $_SESSION['isConnected'] = true;
                    $_SESSION['isAdmin'] = $user['statut'];
                    $data = [   'isConnected'=>$_SESSION['isConnected'],
                                'isAdmin'=>$_SESSION['statut']];
                    $this->render( 'index', $data );
                } else {
                    $data = [ 
                        'message' => 'Erreur : votre mot de passe est incorect' 
                    ];
                    $this->render( 'connexion', $data );
                }
            
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
