<?php

namespace Egulias\EmailValidator\Exception;

use ScarletSpruce\EmailSanitizer\Exception\SanitizeWarningException;

class NoDomainPart extends SanitizeWarningException
{
    const CODE = 231;
    const REASON = "No Domain part";
}
