<?php
namespace controller;

class IndexController extends Controller
{


    public function defaultAction()
    {
        $data = [
            'isConnected' => $_SESSION['isConnected']
        ];

        $this->render( 'index', $data );
    }




    public function topMenuAction()
    {


    }




}