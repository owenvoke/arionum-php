<?php

namespace pxgamer\Arionum\Helpers;

use Exception;
use StephenHill\Base58;

final class Key
{
    public const EC_PUBLIC_START = '-----BEGIN PUBLIC KEY-----';
    public const EC_PUBLIC_END = '-----END PUBLIC KEY-----';
    public const EC_PRIVATE_START = '-----BEGIN EC PRIVATE KEY-----';
    public const EC_PRIVATE_END = '-----END EC PRIVATE KEY-----';

    /**
     * @param  string  $data
     * @param  bool  $isPrivateKey
     *
     * @return string
     *
     * @throws Exception
     *
     * @internal
     */
    public static function aroBase58ToPem(string $data, bool $isPrivateKey = false): string
    {
        $keyData = base64_encode((new Base58())->decode($data));
        $keyData = str_split($keyData, 64);
        $keyData = implode(PHP_EOL, $keyData);

        return $isPrivateKey ?
            sprintf("%s\n%s\n%s", self::EC_PRIVATE_START, $keyData, self::EC_PRIVATE_END) :
            sprintf("%s\n%s\n%s", self::EC_PUBLIC_START, $keyData, self::EC_PUBLIC_END);
    }

    /**
     * @param  string  $data
     *
     * @return string
     *
     * @throws Exception
     *
     * @internal
     */
    public static function pemToBase58(string $data): string
    {
        return (new Base58())->encode(
            base64_decode(
                str_replace([
                    '-----BEGIN PUBLIC KEY-----',
                    '-----END PUBLIC KEY-----',
                    '-----BEGIN EC PRIVATE KEY-----',
                    '-----END EC PRIVATE KEY-----',
                    "\n",
                ], '', $data)
            )
        );
    }
}
