<?php
namespace model;

class Commentaires
{
    private $_id,
            $_id_billet,
            $_auteur,
            $_commentaire,
            $_date_commentaire;



    public function getId()
    {
        return $this->_id;
    }

    public function getIdBillet()
    {
        return $this->_id_billet;
    }

    public function getAuteur()
    {
        return $this->_auteur;
    }

    public function getCommentaire()
    {
        return $this->_commentaire;
    }

    public function getDateCommentaire()
    {
        return $this->_date_commentaire;
    }

    public function setId( $id )
    {
        $id = (int)$id;
        if( $id > 0 ) {
            $this->_id = $id;
        }
    }

    public function setAuteur( $auteur )
    {
        if( !empty( $auteur ) ) {
            $this->_auteur = $auteur;
        }
    }

    public function setCommentaire( $commentaire )
    {
        $this->_commentaire = $commentaire;
    }

    public function setDateCommentaire( $dateCommentaire )
    {
        $this->_date_commentaire = $dateCommentaire;
    }

}
