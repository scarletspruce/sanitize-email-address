<?php

namespace ScarletSpruce\EmailSanitizer\Exception;

/**
 * Class SanitizeWarningException
 * @package ScarletSpruce\EmailSanitizer\Exception
 */
class SanitizeWarningException extends \InvalidArgumentException
{
    const REASON = "Sanitize warning";
    const CODE = 200;
    
    public function __construct()
    {
        parent::__construct(static::REASON, static::CODE);
    }

    public function message()
    {
        return self::REASON;
    }

    public function code()
    {
        return self::CODE;
    }


}
