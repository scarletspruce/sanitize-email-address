<?php

namespace ScarletSpruce\EmailSanitizer;

use ScarletSpruce\EmailSanitizer\Sanitize\EmailSanitizerInterface;

/**
 * Class EmailSanitize
 * @package ScarletSpruce\EmailSanitizer
 */
class EmailSanitize
{
    /**
     * @var array
     */
    protected $warnings;

    /**
     * @param                 $email
     * @param EmailSanitizerInterface $emailSanitizer
     * @return bool
     */
    public function sanitize($email, EmailSanitizerInterface $emailSanitizer)
    {
        $email = $emailSanitizer->sanitize($email);
        $this->warnings = $emailSanitizer->getWarnings();

        return $email;
    }

    /**
     * @return boolean
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

}
