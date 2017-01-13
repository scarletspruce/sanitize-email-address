<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Warning;

use ScarletSpruce\EmailSanitizer\Exception\SanitizeWarningException;

/**
 * Class MultipleWarning
 * @package ScarletSpruce\EmailSanitizer\Sanitize
 */
class MultipleWarning extends SanitizeWarningException
{
    const CODE = 299;
    const REASON = "Accumulated warning for multiple sanitizers";
    /**
     * @var array
     */
    private $warnings = [];

    public function __construct(array $warnings)
    {
        $this->warnings = array_unique(array_filter($warnings));
        parent::__construct();
    }

    public function getWarnings()
    {
        return $this->warnings;
    }

    public function __toString()
    {
        return $this->message() . " Warnings: " . implode(". ",
                $this->getWarnings()) . ". Interal code: " . static::CODE;
    }
}
