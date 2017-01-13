<?php

namespace ScarletSpruce\EmailSanitizer\Exception;


class InvalidEmail extends SanitizeException
{
    const REASON = "Invalid email";
    const CODE = 0;
}
