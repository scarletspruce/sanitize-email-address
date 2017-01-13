<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use Egulias\EmailValidator\Validation\Exception\EmptySanitizersList;
use ScarletSpruce\EmailSanitizer\Exception\SanitizeException;
use ScarletSpruce\EmailSanitizer\Sanitize\EmailSanitizerInterface;

/**
 * Class MultipleEmailSanitizerWithAnd
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class MultipleEmailSanitizerWithAnd implements EmailSanitizerInterface
{
    /**
     * @var EmailSanitizerInterface[]
     */
    private $sanitizers = [];

    /**
     * @var array
     */
    private $warnings = [];


    /**
     * @param EmailSanitizerInterface[] $sanitizers The santitizers.
     */
    public function __construct(array $sanitizers)
    {
        if (count($sanitizers) == 0) {
            throw new EmptySanitizersList();
        }

        foreach ($sanitizers as $sanitizer) {
            if (!$sanitizer instanceof EmailSanitizerInterface) {
                throw new SanitizeException('Sanitizer must implements EmailSanitizerInterface');
            }
        }

        $this->sanitizers = $sanitizers;
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        $result = true;
        $warnings = [];
        foreach ($this->sanitizers as $sanitizer) {
            $email = $sanitizer->sanitize($email);
            if ($sanitizer->getWarnings()) {
                $warnings[] = $sanitizer->getWarnings();
            }

        }

        if (!empty($warnings)) {
            $this->warnings = new MultipleWarning($warnings);
        }

        return $result;
    }
}
