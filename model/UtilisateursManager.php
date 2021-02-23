<?php
namespace model;

class UtilisateursManager extends Manager
{
    public function getAllUtilisateurs()
    {
        $listUtilisateurs = [];
        $q = $this->manager
            ->db
            ->prepare(
                'SELECT * FROM utilisateurs'
            );
        $q->execute();

        while( $donnees = $q->fetch(\PDO::FETCH_ASSOC) ) {
            $listUtilisateurs[] = $donnees;
        }
        return $listUtilisateurs;
    }

    public function createUtilisateur()
    {
        
    }

    public function getUtilisateur($idUtilisateur)
    {
        $q = $this->manager
            ->db
            ->prepare(
                'SELECT 
                    *
                FROM utilisateurs 
                WHERE id = :id'
            );
        $q->execute([':id' => $idUtilisateur]);
        return $q->fetch(\PDO::FETCH_ASSOC);
    }
}

?>