<?php
    // Le message en clair
    $message = "Hello World";

    // On génère la clé secrète avec le Générateur Pseudo-Aléatoire Cryptographique de PHP
    // SODIUM_CRYPTO_SECRETBOX_KEYBYTES est une constante de Libsodium qui indique la taille de clé de secretbox, qui est de 32 octets soit 256 bits
    $cle_secrete = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);

    // On peut afficher la clé en la représentant en hexadécimal
    echo bin2hex($cle_secrete) . '<br/>';

    // Le nonce est généré aléatoirement, de taille 192 bits
    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

    // On chiffre le message avec la fonction sodium_crypto_secretbox
    $texte_chiffre = sodium_crypto_secretbox($message, $nonce, $cle_secrete);

    // On affiche le texte chiffré sous forme hexadecimal
    echo bin2hex($texte_chiffre) . '<br/>';

    // On dechiffre le texte chiffré avec la fonction sodium_crypto_secretbox_open
    // Notez qu'il est nécessaire de connaitre le nonce pour déchiffrer le texte. Le nonce peut être transmit en clair en même temps que le texte chiffré
    $message_dechiffre = sodium_crypto_secretbox_open($texte_chiffre, $nonce, $cle_secrete);

    if ($message_dechiffre === false) {
    // Le texte chiffré, le code MAC, la clé ou le nonce est invalide
        throw new Exception("Erreur de déchiffrement");
    }

    // On affiche le message déchiffré
    echo $message_dechiffre . PHP_EOL;
?>
