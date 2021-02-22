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
                'SELECT 
                    id, 
                    nom, 
                    prenom, 
                    identifiant,
                    mot_de_passe, 
                FROM utilisateurs
                ORDER BY id'
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
}

?>