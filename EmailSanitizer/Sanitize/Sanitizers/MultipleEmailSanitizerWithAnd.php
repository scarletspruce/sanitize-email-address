<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use Exception;
use ScarletSpruce\EmailSanitizer\EmailSanitizer\Exception\EmptySanitizersList;
use ScarletSpruce\EmailSanitizer\Exception\MultipleErrors;
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
     * @var Exception
     */
    private $error;


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
     * Returns the validation error.
     *
     * @return \Exception|null
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
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        $errors = [];

        foreach ($this->sanitizers as $sanitizer) {
            try {
                $email = $sanitizer->sanitize($email);

                $this->warnings = array_merge($this->warnings, $sanitizer->getWarnings());

                if (null !== $this->getError()) {
                    $errors[] = $this->getError();
                }

            } catch (Exception $e) {

                $errors[] = $e;
            }
        }

        if (!empty($errors)) {
            $this->error = (new MultipleErrors())->setErrors($errors);
        }

        return $email;
    }
}
