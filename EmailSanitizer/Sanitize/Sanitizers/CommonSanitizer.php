<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use Egulias\EmailValidator\Validation\Exception\EmptySanitizersList;

/**
 * Class CommonSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class CommonSanitizer extends AbstractSanitizer
{

    /**
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }
}
