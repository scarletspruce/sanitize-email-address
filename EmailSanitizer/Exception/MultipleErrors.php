<?php

namespace ScarletSpruce\EmailSanitizer\Exception;


/**
 * Class MultipleWarning
 * @package ScarletSpruce\EmailSanitizer\Sanitize
 */
class MultipleErrors extends SanitizeErrorException
{
    const CODE = 199;
    const REASON = "Accumulated errors for multiple sanitizers";
    /**
     * @var array
     */
    private $errors = [];


    public function setErrors(array $errors = [])
    {
        $this->errors = array_unique(array_filter($errors));
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function __toString()
    {
        return self::REASON . " Errors: " . implode(". ",
                $this->getErrors()) . ". Internal code: " . self::CODE;
    }
}
