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

    public function createUtilisateur(Utilisateurs $utilisateurs)
    {
        $q = $this->manager
                    ->db
                    ->prepare('INSERT INTO utilisateurs (nom, prenom, login, mot_de_passe)
                                VALUES ( :nom, :prenom, :login, :mot_de_passe)'
                    );
        $ret = $q->execute([
            ':nom' => $utilisateurs->getNom(),
            ':prenom' => $utilisateurs->getPrenom(),
            ':login' => $utilisateurs->getLogin(),
            ':mot_de_passe' => $utilisateurs->getMotdepasse(),
            
        ]);
        if( $ret ) {
            $ret = $this->manager->db->lastInsertId();
        }
        return $ret;
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

    public function supprUtilisateur($idUtilisateur)
    {
        $q = $this->manager
            ->db
            ->prepare(
                'DELETE FROM utilisateur
                WHERE id = :id'
            );
        $q->execute([':id' => $idUtilisateur]);
        return $q->fetch(\PDO::FETCH_ASSOC);
    }

    public function verifUtilisateur($login, $mot_de_passe)
    {
        
    }
}

?>