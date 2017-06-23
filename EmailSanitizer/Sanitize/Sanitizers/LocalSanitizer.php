<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use ScarletSpruce\EmailSanitizer\Sanitize\Traits\EmailBuilderTrait;
use ScarletSpruce\EmailSanitizer\Sanitize\Traits\EmailInfoTrait;

/**
 * Class LocalSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class LocalSanitizer extends AbstractSanitizer
{
    use EmailInfoTrait;
    use EmailBuilderTrait;

    /**
     * Incorrect first char
     *
     * @todo-dev Move to the config
     * @var array
     */
    private $incorrectFirstChar = [
        'й' => 'q',
        'ц' => 'w',
        'у' => 'e',
        'к' => 'r',
        'е' => 't',
        'н' => 'y',
        'г' => 'u',
        'ш' => 'i',
        'щ' => 'o',
        'з' => 'p',
        'ф' => 'a',
        'ы' => 's',
        'в' => 'd',
        'а' => 'f',
        'п' => 'g',
        'р' => 'h',
        'о' => 'j',
        'л' => 'k',
        'д' => 'l',
        'я' => 'z',
        'ч' => 'x',
        'с' => 'c',
        'м' => 'v',
        'и' => 'b',
        'т' => 'n',
        'ь' => 'm',
    ];

    /**
     * Chars to convert (lowercase)
     *
     * @todo-dev Move to the config
     * @var array
     */
    private $utfLower = [
        'а' => 'a',
        'е' => 'e',
        'к' => 'k',
        'о' => 'o',
        'p' => 'p',
        'с' => 'c',
        'у' => 'y',
        'х' => 'x',
    ];

    /**
     * Clean name
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        $this->setEmail($email);
        $namePart = trim($this->getLocalPart(), '.@');


        if (
            preg_match('/^[а-я]/iu', $namePart) &&
            preg_match('/.[^а-я]/iu', $namePart) &&
            isset($this->incorrectFirstChar[$this->getFirstLocalChar()])
        ) {
            $namePart[0] = $this->incorrectFirstChar[$this->getFirstLocalChar()];
        }

        if (!$this->isAscii($namePart)) {
            $namePart = str_replace(array_keys($this->utfLower), array_values($this->utfLower), $namePart);
        }

        $domainPart = ltrim($this->getDomainPart(), '-.@');

        return $this->buildEmail($namePart, $domainPart);
    }

    /**
     * Tests whether a string contains only 7-bit ASCII bytes.
     * This is used to determine when to use native functions or UTF-functions.
     *
     * <code>
     *     var_dump($email->isAscii($string));
     * <code>
     *
     * @param string $text String or array of strings to check
     *
     * @return bool
     */
    private function isAscii($text)
    {
        return !preg_match('/[^\x00-\x7F]/S', $text);
    }
}
