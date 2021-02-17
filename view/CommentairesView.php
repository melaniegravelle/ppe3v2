<?php
require 'header.php';
?>

<section class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-9">
                <p><a href="index.php" class="btn btn-secondary">Retour à la liste des billets</a></p>

                <div class="card mt-5">
                    <div class="card-header">
                        <em>publié le <?php echo $billet['date_creation_fr']; ?></em>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($billet['titre']); ?></h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($billet['contenu'])); ?></p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mt-5">
            <div class="col-9">

                <h3>Commentaires</h3>

                <div class="list-group">
                    <?php

                    foreach ( $listCommentaires as $commentaire )
                    {
                        ?>

                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo htmlspecialchars($commentaire['auteur']); ?></h5>
                                <small><?php echo htmlspecialchars($commentaire['auteur']); ?></strong> le <?php echo $commentaire['date_commentaire_fr']; ?></small>
                            </div>
                            <p class="mb-1"><?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?></p>
                        </a>
                        <?php
                    } // Fin de la boucle des commentaires
                    ?>
                </div>
            </div>
        </div>


    </section>

<?php
require 'footer.php';
?>
