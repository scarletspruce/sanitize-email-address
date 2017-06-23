<?php

namespace ScarletSpruce\EmailSanitizer\Exception;

/**
 * Class SanitizeException
 * @package ScarletSpruce\EmailSanitizer\Exception
 */
class SanitizeErrorException extends SanitizeException
{
    const REASON = "Sanitize error";
    const CODE = 100;
}
