<?php
namespace model;

class EquipesManager extends Manager
{
    public function getAllEquipes()
    {
        $listEquipes = [];
        $q = $this->manager
            ->db
            ->prepare(
                'SELECT * FROM equipes'
            );
        $q->execute();

        while( $donnees = $q->fetch(\PDO::FETCH_ASSOC) ) {
            $listEquipes[] = $donnees;
        }
        return $listEquipes;
    }
}