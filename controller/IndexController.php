<?php
namespace controller;

class IndexController extends Controller
{


    public function defaultAction()
    {
        $data = [
            'message'=>"Bienvenue sur le site de gestion d'équipe"
        ];

        $this->render( 'index', $data );
    }




    public function topMenuAction()
    {


    }




}