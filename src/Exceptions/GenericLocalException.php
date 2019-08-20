<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Exceptions;

final class GenericLocalException extends ArionumException
{
    public static function failedToGenerateLocalAccountKeyPair(): self
    {
        return new self('Failed to generate a local account key pair');
    }
}
