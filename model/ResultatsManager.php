<?php
namespace model;

class ResultatsManager extends Manager
{
    public function getAllResultats()
    {
        $listResultats = [];
        $q = $this->manager
            ->db
            ->prepare(
                'SELECT * FROM resultats'
            );
        $q->execute();

        while( $donnees = $q->fetch(\PDO::FETCH_ASSOC) ) {
            $listResultats[] = $donnees;
        }
        return $listResultats;
    }
}