<?php

namespace ScarletSpruce\EmailSanitizer;

use ScarletSpruce\EmailSanitizer\Exception\SanitizeException;
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
     * @var SanitizeException
     */
    protected $error;

    /**
     * @param                 $email
     * @param EmailSanitizerInterface $emailSanitizer
     * @return bool
     */
    public function sanitize($email, EmailSanitizerInterface $emailSanitizer)
    {
        $email = $emailSanitizer->sanitize($email);
        $this->warnings = $emailSanitizer->getWarnings();
        $this->error = $emailSanitizer->getError();

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

    /**
     * @return boolean
     */
    public function hasError()
    {
        return !empty($this->error);
    }

    /**
     * @return SanitizeException
     */
    public function getError()
    {
        return $this->error;
    }

}
