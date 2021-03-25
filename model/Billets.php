<?php
namespace model;

class Billets
{
    private $_id,
            $_titre,
            $_contenu,
            $_date_creation;


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))  {
                $this->$method($value);
            }
        }
    }


    public function getId()
    {
        return $this->_id;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

    public function getContenu()
    {
        return $this->_contenu;
    }

    public function getDateCreation()
    {
        return $this->_date_creation;
    }


    /**
     * @param integer $id
     */
    public function setId($id)
    {
        if( is_integer( $id ) ) {
            $this->_id = $id;
        } else return false;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->_contenu = $contenu;
    }

    /**
     * @param string $date_creation
     */
    public function setDate_creation($date_creation)
    {
        $this->_date_creation = $date_creation;
    }

}