<?php

namespace ScarletSpruce\EmailSanitizer\Exception;

/**
 * Class SanitizeException
 * @package ScarletSpruce\EmailSanitizer\Exception
 */
class SanitizeException extends \InvalidArgumentException
{
    const REASON = "Sanitize error";
    const CODE = 100;

    public function __construct($message = null)
    {
        $message = $message
            ? $message
            : self::REASON;

        parent::__construct($message, static::CODE);
    }
}
