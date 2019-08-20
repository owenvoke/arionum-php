<?php

namespace pxgamer\Arionum\Models;

use Exception;
use StephenHill\Base58;
use pxgamer\Arionum\Helpers\Key;
use pxgamer\Arionum\Exceptions\GenericLocalException;

final class Account
{
    private const CURVE_NAME = 'secp256k1';
    private const PRIVATE_KEY_TYPE = OPENSSL_KEYTYPE_EC;

    /** @var string */
    private $publicKey;
    /** @var string */
    private $privateKey;

    public function __construct(string $publicKey, string $privateKey)
    {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    /**
     * @return self
     *
     * @throws GenericLocalException
     */
    public static function make(): self
    {
        try {
            // Using secp256k1 curve for ECDSA
            $args = [
                'curve_name' => self::CURVE_NAME,
                'private_key_type' => self::PRIVATE_KEY_TYPE,
            ];

            // Generates a new key pair
            $keyPair = openssl_pkey_new($args);

            // Exports the private key encoded as PEM
            openssl_pkey_export($keyPair, $privateKeyPem);

            // Converts the PEM to a base58 format
            $privateKey = Key::pemToBase58($privateKeyPem);

            // Exports the private key encoded as PEM
            $pub = openssl_pkey_get_details($keyPair);

            // Converts the PEM to a base58 format
            $publicKey = Key::pemToBase58($pub['key']);
        } catch (Exception $exception) {
            throw GenericLocalException::failedToGenerateLocalAccountKeyPair();
        }

        return new self($publicKey, $privateKey);
    }

    public function getAddress(): string
    {
        $hash = $this->publicKey;

        // Hashes 9 times in sha512 (binary) and encodes in base58
        for ($i = 0; $i < 9; $i++) {
            $hash = hash('sha512', $hash, true);
        }

        return (new Base58())->encode($hash);
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }
}
