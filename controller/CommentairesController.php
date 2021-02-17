<?php
namespace controller;

use model\BilletsManager;
use model\CommentairesManager;

class CommentairesController extends Controller
{

    public function defaultAction()
    {
        $idBillet = $_REQUEST['billet'];

        $billetManager = new BilletsManager();
        $commentManager = new CommentairesManager();

        $billet = $billetManager->getBillet( $idBillet );
        $listCommentaires = $commentManager->getCommentaires( $idBillet );

        $data = [
            'billet'=>$billet,
            'listCommentaires'=> $listCommentaires
        ];

        $this->render( 'commentaires', $data );

    }

}
