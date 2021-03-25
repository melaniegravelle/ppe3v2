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
                    ->prepare('INSERT INTO utilisateurs (nom, prenom, statut, login, mot_de_passe)
                                VALUES ( :nom, :prenom, :statut, :login, :mot_de_passe)'
                    );
        $ret = $q->execute([
            ':nom' => $utilisateurs->getNom(),
            ':prenom' => $utilisateurs->getPrenom(),
            ':login' => $utilisateurs->getLogin(),
            ':mot_de_passe' => $utilisateurs->getMotdepasse(),
            ':statut' => $utilisateurs->getStatut(),
            
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
                'DELETE FROM utilisateurs
                WHERE id = :id'
            );
        $res = $q->execute([':id' => $idUtilisateur]);
        return $res;
    }

    public function modifUtilisateur($idUtilisateur)
    {
        $q = $this->manager
            ->db
            ->prepare(
                'UP utilisateurs 
                SET nom = :nom,
                    prenom = :prenom,
                    login = :login,
                    mot_de_passe = :mot_de_passe
                WHERE id = :id'
            );
        $res = $q->execute([':id' => $idUtilisateur]);
        return $res;
    }

    public function verifUtilisateur($login, $mot_de_passe)
    {

        $q = $this->manager
                ->db
                ->prepare(
                    "SELECT * FROM utilisateurs 
                    WHERE login=:login AND mot_de_passe=:mot_de_passe"
        );
        $q->execute([
            ':login' => $login,
            ':mot_de_passe' => $mot_de_passe]
        );

        return $q->fetch(\PDO::FETCH_ASSOC);
    }
}
?>
