<?php


namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;


use ScarletSpruce\EmailSanitizer\Sanitize\EmailSanitizerInterface;

abstract class AbstractSanitizer implements EmailSanitizerInterface
{
    protected $warnings = [];

    protected $error;

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Returns sanitized email
     *
     * @return bool
     */
    abstract function sanitize($email);
}