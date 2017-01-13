<?php

namespace ScarletSpruce\EmailSanitizer\Exception;

class NoDomainPart extends SanitizeWarningException
{
    const CODE = 231;
    const REASON = "No Domain part";
}
