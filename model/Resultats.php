<?php
namespace model;

class Resultats
{
    private $_id_resultat,
            $_id_equipe,
            $_equipe_domicile,
            $_equipe_visiteur,
            $_journee,
            $_resultat_domicile,
            $_resultat_visiteur;

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

    public function getIdResultat()
    {
        return $this->_id_resultat;
    }

    public function getIdEquipe()
    {
        return $this->_id_equipe;
    }

    public function getEquipeDomicile()
    {
        return $this->_equipe_domicile;
    }

    public function getEquipeVisiteur()
    {
        return $this->_equipe_visiteur;
    }

    public function getJournee()
    {
        return $this->_journee;
    }

    public function getResultatDomicile()
    {
        return $this->_resultat_domicile;
    }

    public function getResultatVisiteur()
    {
        return $this->_resultat_visiteur;
    }

    /* --------------- SET --------------- */

    public function setIdResultat($_id_resultat)
    {
        $this->_id_resultat = $_id_resultat;
    }
    
    public function setIdEquipe($_id_equipe)
    {
        $this->_id_equipe = $_id_equipe;
    }

    public function setEquipeDomicile($_equipe_domicile)
    {
        $this->_equipe_domicile = $_equipe_domicile;
    }

    public function setEquipeVisiteur($_equipe_visiteur)
    {
        $this->_equipe_visiteur = $_equipe_visiteur;
    }

    public function setJournee($_journee)
    {
        $this->_journee = $_journee;
    }

    public function setResultatDomicile($_resultat_domicile)
    {
        $this->_resultat_domicile = $_resultat_domicile;
    }
    
    public function setResultatVisiteur($_resultat_visiteur)
    {
        $this->_resultat_visiteur = $_resultat_visiteur;
    }
    
}