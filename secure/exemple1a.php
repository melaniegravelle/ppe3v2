<?php

$msg = 'This is the message to authenticate!';
$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); // 256 bit

// Generate the Message Authentication Code
$mac = sodium_crypto_auth($msg, $key);

// Altering $mac or $msg, verification will fail
echo sodium_crypto_auth_verify($mac, $msg, $key) ? 'Success' : 'Error';

