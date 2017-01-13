<?php

namespace Egulias\EmailValidator\Validation\Exception;

use ScarletSpruce\EmailSanitizer\Exception\SanitizeException;

/**
 * Class EmptySanitizersList
 * @package Egulias\EmailValidator\Validation\Exception
 */
class EmptySanitizersList extends SanitizeException
{
    const REASON = 'Empty validation list is not allowed';
}
