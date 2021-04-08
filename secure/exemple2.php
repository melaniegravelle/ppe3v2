<?php
$mot_de_passe_en_clair = "monMot2Passe";

// Retourne le haché du mot de passe avec la fonction Argon2. Le haché contient un salt généré aléatoirement et peut être stocké en base de données
$mot_de_passe_hache = sodium_crypto_pwhash_str(
    $mot_de_passe_en_clair,
    SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
    SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
);

//...
// Vérification du mot de passe
$mot_de_passe_fourni = "monMot2Passe";

// sodium_crypto_pwhash_str_verify s'occupe à la fois de hacher le mot de passe fourni avec le salt du mot de passe stocké et de comparer les 2 hachés. La comparaison se fait en temps constant pour éviter les 'timing attacks", qui permettent de deviner le mot de passe lettre par lettre.
if (sodium_crypto_pwhash_str_verify($mot_de_passe_hache, $mot_de_passe_fourni)) {
    echo "Mot de passe valide";
} else {
    echo "Mot de passe invalide";
}
// Par précaution, on peut effacer de manière sécurisée de la mémoire vive le contenu du mot de passe en clair
sodium_memzero($mot_de_passe_fourni);
?>
