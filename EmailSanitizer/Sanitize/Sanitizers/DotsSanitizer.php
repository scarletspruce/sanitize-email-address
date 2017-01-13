<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use Egulias\EmailValidator\Validation\Exception\EmptySanitizersList;
use ScarletSpruce\EmailSanitizer\Exception\SanitizeException;
use ScarletSpruce\EmailSanitizer\Sanitize\EmailSanitizerInterface;

/**
 * Class DotsSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class DotsSanitizer extends AbstractSanitizer
{

    /**
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        return preg_replace('(\.[.]+)', '.', $email);
    }
}
