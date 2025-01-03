<?php

namespace App\Services;

use DateTimeImmutable;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Ecdsa\MultibyteStringConverter;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class AppleMusicService
{
    private $teamId = '3LCQMT6G6T';
    private $keyId = 'SZY83GTJX7';

    public function generateToken(): string
    {

        $privateKeyPath = env('APPLE_MUSIC_PRIVATE_KEY_PATH');
        $privateKeyContent = file_get_contents(base_path($privateKeyPath));


        if ($privateKeyContent === false) {
            throw new \RuntimeException('Unable to read the private key file.');
        }


        $config = Configuration::forAsymmetricSigner(
            Sha256::create(new MultibyteStringConverter()),
            InMemory::plainText($privateKeyContent),
            InMemory::empty()
        );


        $now = new DateTimeImmutable();
        $token = $config->builder()
            ->issuedBy($this->teamId)
            ->withHeader('kid', $this->keyId)
            ->issuedAt($now)
            ->expiresAt($now->modify('+6 months'))
            ->getToken($config->signer(), $config->signingKey());

        return $token->toString();
    }
}
