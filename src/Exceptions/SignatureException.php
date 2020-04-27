<?php

namespace OwenVoke\Arionum\Exceptions;

final class SignatureException extends ArionumException
{
    public static function unableToGenerateSignature(): self
    {
        return new self('Unable to generate a transaction signature');
    }
}
