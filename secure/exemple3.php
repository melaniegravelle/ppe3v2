<?php
// Génère une paire de clés privée/publique
$paire_cle_Alice = sodium_crypto_sign_keypair();

// Extrait chaque clé dans une variable
$cle_privee_Alice = sodium_crypto_sign_secretkey($paire_cle_Alice);
$cle_publique_Alice = sodium_crypto_sign_publickey($paire_cle_Alice);

echo 'Clé publique : '. bin2hex($cle_publique_Alice).'<br/>';
echo 'Clé privée : '. bin2hex($cle_privee_Alice).'<br/>';

$message = "Ce message n'est pas confidentiel, mais il est signe par Alice";

$message_signe = sodium_crypto_sign($message, $cle_privee_Alice);
// $message_signe contient à la fois le message et la signature du message.
// Il peut donc être envoyé tel quel



//....
// Pour vérifier la signature
$message_originel = sodium_crypto_sign_open(
    $message_signe,
    $cle_publique_Alice
);
if ($message_originel === false) {
    throw new Exception("Signature invalide");
} else {
    echo $message_originel;
}
?>