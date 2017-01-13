<?php
namespace ScarletSpruce\EmailSanitizer\Sanitize\Traits;


trait EmailBuilderTrait
{
    public function buildEmail($local, $domain)
    {
        return $local . '@' . $domain;
    }
}