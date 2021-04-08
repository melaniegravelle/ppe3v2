<?php
namespace model;

class Equipes
{
    private $_id_equipe,
            $_nom_equipe,
            $_nom_entraineur,
            $_logo;

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

    public function getIdEquipe()
    {
        return $this->_id_equipe;
    }

    public function getNomEquipe()
    {
        return $this->_nom_equipe;
    }

    public function getNomEntraineur()
    {
        return $this->_nom_entraineur;
    }

    public function getLogo()
    {
        return $this->_logo;
    }

    /* --------------- SET --------------- */

    public function setIdEquipe($_id_equipe)
    {
        $this->_id_equipe = $_id_equipe;
    }

    public function setNomEquipe($_nom_equipe)
    {
        $this->_nom_equipe = $_nom_equipe;
    }

    public function setLogo($_logo)
    {
        $this->_logo = $_logo;
    }
}