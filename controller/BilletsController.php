<?php
namespace controller;

use model\Billets;
use model\BilletsManager;

class BilletsController extends Controller
{
    protected $billetManager;

    public function __construct()
    {
        $this->billetManager = new BilletsManager();
        parent::__construct();
    }


    public function defaultAction()
    {

    }


    public function listBilletsAction()
    {
        $listBillets = $this->billetManager->getAllBillets( 5 );
        $data = [ 'listBillets'=>$listBillets ];
        $this->render( 'listBillets', $data );
    }



    public function createBilletAction()
    {
        $data = [];
        if( isset( $_REQUEST['titre'] ) ) {
            $dataDb = [
                'titre'         => $_REQUEST['titre'],
                'contenu'       => $_REQUEST['contenu'],
                'date_creation'  => date( 'Y-m-d G:i:s')
            ];
            $newBillet = new Billets( $dataDb );

            if( $id = $this->billetManager->createBillet( $newBillet ) ) {
                $newBillet->setId( $id );
                $data = [
                    'id'        => $id,
                    'billet'    => $dataDb
                ];
            } else {
                $data = [
                    'billet'    => false,
                    'errorMess' => 'An mistery error occured'
                ];
            }
        }
        $this->render( 'createBillet', $data );
    }
}