<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize;

use ScarletSpruce\EmailSanitizer\Exception\SanitizeWarningException;

/**
 * Interface EmailSanitizerInterface
 * @package ScarletSpruce\EmailSanitizer\Sanitize
 */
interface EmailSanitizerInterface
{
    /**
     * Returns sanitized email
     *
     * @return bool
     */
    public function sanitize($email);

    /**
     * Returns the validation warnings.
     *
     * @return SanitizeWarningException[]
     */
    public function getWarnings();
}
