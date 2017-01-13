<?php

namespace ScarletSpruce\EmailSanitizer\Exception;

class NoDomainPart extends SanitizeErrorException
{
    const CODE = 231;
    const REASON = "No Domain part";
}
