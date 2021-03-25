<?php
namespace model;

class Utilisateurs
{
    private $_id,
            $_nom,
            $_prenom,
            $_login,
            $_mot_de_passe,
            $_pays,
            $_ville,
            $_code_postal;

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

    /* --------------- GET --------------- */

    public function getId()
    {
        return $this->_id;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function getPrenom()
    {
        return $this->_prenom;
    }

    public function getLogin()
    {
        return $this->_login;
    }

    public function getMotDePasse()
    {
        return $this->_mot_de_passe;
    }

    /* --------------- SET --------------- */

    public function setId($id)
    {
        $this->_id = $id;
    }
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }
    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }
    public function setLogin($login)
    {
        $this->_login = $login;
    }
    public function setMotDePasse($mot_de_passe)
    {
        $this->_mot_de_passe = $mot_de_passe;
    }

}