<?php

namespace pxgamer\Arionum;

/**
 * Class ApiException
 */
class ApiException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'An unknown API error occurred.';
}
