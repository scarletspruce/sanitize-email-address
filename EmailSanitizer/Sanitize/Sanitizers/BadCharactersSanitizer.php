<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

/**
 * Class BadCharactersSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class BadCharactersSanitizer extends AbstractSanitizer
{
    /**
     * Bad symbols for sanitize
     *
     * @var array
     */
    private $badChars = [
        '/',
        '\\',
        '<',
        '>',
        ',',
        '$',
        '?',
        ':',
        ';',
        "\t",
        "\n",
        "\r",
        '"',
        "'",
        ' ',
        '*',
        '#',
        '&',
    ];

    public function __construct(array $badChars = [])
    {
        if ($badChars) {
            $this->badChars = array_merge($this->badChars, $badChars);
        }
    }


    /**
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        return str_replace($this->badChars, '', $email);
    }
}
