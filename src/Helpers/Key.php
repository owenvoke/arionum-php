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
     * @param string $data
     * @return string
     */
    public static function pemToHexadecimal(string $data): string
    {
        return bin2hex(self::pemToBase64($data));
    }

    /**
     * @param string $data
     * @param bool   $isPrivateKey
     * @return string
     */
    public static function hexadecimalToPem(string $data, bool $isPrivateKey = false): string
    {
        $data = hex2bin($data);
        $data = base64_encode($data);
        return $isPrivateKey ?
            sprintf("%s\n%s\n%s", self::EC_PRIVATE_START, $data, self::EC_PRIVATE_END) :
            sprintf("%s\n%s\n%s", self::EC_PUBLIC_START, $data, self::EC_PUBLIC_END);
    }

    /**
     * @param string $data
     * @return string
     */
    public static function hexadecimalToAroBase58(string $data): string
    {
        return (new Base58())->encode(hex2bin($data));
    }

    /**
     * @param string $data
     * @return string
     */
    public static function pemToAroBase58(string $data): string
    {
        return (new Base58())->encode(self::pemToBase64($data));
    }

    /**
     * @param string $data
     * @param bool   $isPrivateKey
     * @return string
     * @throws Exception
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
     * @param string $data
     * @return string
     */
    private static function pemToBase64(string $data): string
    {
        return base64_decode(
            str_replace(
                [
                    self::EC_PUBLIC_START,
                    self::EC_PUBLIC_END,
                    self::EC_PRIVATE_START,
                    self::EC_PRIVATE_END,
                ],
                '',
                $data
            )
        );
    }
}
