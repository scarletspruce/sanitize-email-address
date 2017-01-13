<?php

namespace ScarletSpruce\EmailSanitizer\Exception;

/**
 * Class SanitizeException
 * @package ScarletSpruce\EmailSanitizer\Exception
 */
class SanitizeException extends \InvalidArgumentException
{
    const REASON = "Sanitize exception";
    const CODE = 0;

    public function __construct($message = null)
    {
        $message = $message
            ? $message
            : static::REASON;

        parent::__construct($message, static::CODE);
    }

    public function __toString()
    {
        return $this->message . '[' . $this->getCode() . ']';
    }
}
