<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use ScarletSpruce\EmailSanitizer\EmailSanitizer\Exception\EmptySanitizersList;
use ScarletSpruce\EmailSanitizer\Exception\SanitizeException;
use ScarletSpruce\EmailSanitizer\Sanitize\EmailSanitizerInterface;
use ScarletSpruce\EmailSanitizer\Sanitize\Warning\MultipleWarning;
use Symfony\Component\Config\Definition\Exception\Exception;

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
            try {
                $email = $sanitizer->sanitize($email);
                if ($sanitizer->getWarnings()) {
                    $warnings[] = $sanitizer->getWarnings();
                }
            } catch (Exception $e) {
                $warnings[] = $e->getMessage();
            }
        }

        if (!empty($warnings)) {
            $this->warnings = new MultipleWarning($warnings);
        }

        return $result;
    }
}
