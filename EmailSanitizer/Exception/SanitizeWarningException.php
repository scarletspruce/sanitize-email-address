<?php

namespace ScarletSpruce\EmailSanitizer\Exception;

/**
 * Class SanitizeWarningException
 * @package ScarletSpruce\EmailSanitizer\Exception
 */
class SanitizeWarningException extends SanitizeException
{
    const REASON = "Sanitize warning";
    const CODE = 200;
}
