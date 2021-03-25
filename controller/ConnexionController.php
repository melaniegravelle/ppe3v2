<?php
namespace controller;

class ConnexionController extends Controller
{
    public function defaultAction()
    {
        $data=[];
        $this->render( 'connexion', $data );
    }

    public function deconnexionAction()
    {
        session_destroy();
        $data=[];
        $this->render( 'connexion', $data );
    }
}