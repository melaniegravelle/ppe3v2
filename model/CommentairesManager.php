<?php
namespace model;

class CommentairesManager extends Manager
{


    public function getCommentaires( $idBillet )
    {
        $listCommentaires = [];
        $q = $this->manager
                    ->db
                    ->prepare(
                        'SELECT 
                            auteur, 
                            commentaire, 
                            DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr 
                        FROM commentaires 
                        WHERE id_billet = :id
                        ORDER BY date_commentaire'
            );
        $q->execute([':id' => $idBillet]);
        while( $donnees = $q->fetch(\PDO::FETCH_ASSOC) ) {
            $listCommentaires[] = $donnees;
        }
        return $listCommentaires;
    }



    /**
     * Return numbers of comments for one ticket
     *
     * @param $idBillet
     * @return integer
     */
    public function getNbCommentaires( $idBillet )
    {
        $q = $this->manager
                ->db
                ->prepare(
                    'SELECT count(*)
                    FROM commentaires
                    WHERE id_billet = :id'
                );
        $q->execute( [':id' => $idBillet ] );
        $nb = current( $q->fetch() );
        return $nb;
    }


}