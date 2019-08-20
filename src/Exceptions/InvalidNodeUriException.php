<?php

namespace pxgamer\Arionum\Exceptions;

final class InvalidNodeUriException extends ArionumException
{
    public static function laravelEnvNotSet(): self
    {
        return new self('The configured node uri is invalid. A valid `ARIONUM_NODE_URI` variable should be configured in your environment');
    }
}
