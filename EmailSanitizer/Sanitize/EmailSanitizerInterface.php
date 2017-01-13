<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize;

use Exception;
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

    /**
     * Returns the validation error.
     *
     * @return Exception|null
     */
    public function getError();
}
