<?php
    require 'header.php';
?>

    <section class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-9">
                <p>Derniers billets du blog :</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-9">
                <?php
                foreach( $listBillets as $billet ) {
                    ?>
                    <div class="card mt-5">
                        <div class="card-header">
                            <em>publié le <?php echo $billet['date_creation_fr']; ?></em>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($billet['titre']); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($billet['contenu'])); ?></p>
                            <a href="index.php?controller=commentaires&billet=<?php echo $billet['id']; ?>" class="btn btn-primary"><?php echo $billet['nbComm']; ?> commentaires</a>
                        </div>
                    </div>

                <?php
                } // Fin de la boucle des billets

                ?>
            </div>
        </div>
    </section>

<?php
require 'footer.php';
?>