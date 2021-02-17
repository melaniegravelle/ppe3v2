<?php
namespace controller;

use model\BilletsManager;

class IndexController extends Controller
{


    public function defaultAction()
    {
        $billetManager = new BilletsManager();
        $listBillets = $billetManager->getAllBillets();
        $data = [
            'listBillets'=>$listBillets,
            'message'=>'Bievenue sur mon super blog'
        ];

        $this->render( 'index', $data );
    }




    public function topMenuAction()
    {


    }




}