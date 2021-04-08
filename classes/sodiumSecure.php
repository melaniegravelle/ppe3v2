<?php
namespace classes;

class sodiumSecure
{
    public function hashWord($mot)
    {
        $mot_hache = sodium_crypto_pwhash_str(
            $mot,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE);
        sodium_memzero($mot);
        return $mot_hache;
    }

    public function verifWord($mot_hache, $mot)
    {
        if (sodium_crypto_pwhash_str_verify($mot_hache, $mot)) {
           return true;
        } else {
            return false;
        }
        sodium_memzero($mot);
    }
}

