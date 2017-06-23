<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

/**
 * Class SpaceSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class SpaceSanitizer extends AbstractSanitizer
{
    /**
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        return preg_replace('/\s+/', '', $email);
    }
}
