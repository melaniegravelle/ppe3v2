<?php
namespace model;


class BilletsManager extends Manager
{
    private $_nbBillets = 1;


    public function getBillet( $idBillet )
    {
        $q = $this->manager
            ->db
            ->prepare(
                'SELECT 
                    id, 
                    titre, 
                    contenu, 
                    DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr 
                FROM billets 
                WHERE id = :id'
            );
        $q->execute([':id' => $idBillet]);
        return $q->fetch(\PDO::FETCH_ASSOC);
    }


    public function countBillet()
    {
        $q = $this->manager
            ->db
            ->prepare(
                'SELECT count(*) as nb FROM billets'
            );
        $q->execute();
        $nb = current( $q->fetch() );
        return $nb;
    }



    public function getAllBillets( $nbBillets = false )
    {
        $maxBillets = $nbBillets ? $nbBillets : $this->countBillet();
        $listBillets = [];
        $q = $this->manager
                ->db
                ->prepare(
                    'SELECT 
                        id, 
                        titre, 
                        contenu, 
                        DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr 
                    FROM billets 
                    ORDER BY date_creation 
                    DESC LIMIT 0, ' . $maxBillets
                );
        $q->execute();

        $commentaireManager = new CommentairesManager();
        while( $donnees = $q->fetch(\PDO::FETCH_ASSOC) ) {
            $nbComm = $commentaireManager->getNbCommentaires( $donnees['id'] );
            $donnees['nbComm'] = $nbComm;
            $listBillets[] = $donnees;
        }
        return $listBillets;
    }



    public function createBillet( Billets $billets )
    {
        $q = $this->manager
                    ->db
                    ->prepare('INSERT INTO billets (titre, contenu, date_creation)
                                VALUES ( :titre, :contenu, :dateCreation  )'
                    );
        $ret = $q->execute([
            ':titre' => $billets->getTitre(),
            ':contenu' => $billets->getContenu(),
            ':dateCreation' => $billets->getDateCreation()
        ]);
        if( $ret ) {
            $ret = $this->manager->db->lastInsertId();
        }
        return $ret;
    }



}