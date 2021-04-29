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
        // var_dump($listEquipes);die;
        return $listEquipes;
    }

    public function createEquipe(Equipes $equipes)
    {
        $q = $this->manager
                    ->db
                    ->prepare('INSERT INTO equipes (nom_equipe, nom_entraineur, logo)
                                VALUES ( :nom_equipe, :nom_entraineur, :logo)'
                    );
        $ret = $q->execute([
            ':nom_equipe' => $equipes->getNomEquipe(),
            ':nom_entraineur' => $equipes->getNomEntraineur(),
            ':logo' => $equipes->getLogo(),     
        ]);
        if( $ret ) {
            $ret = $this->manager->db->lastInsertId();
        }
        return $ret;
    }
}