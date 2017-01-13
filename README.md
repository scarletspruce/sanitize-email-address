#EmailSanitizer
=============================
With the help of [PHPStorm](https://www.jetbrains.com/phpstorm/)

##Requirements##

 * [Composer](https://getcomposer.org) is required for installation
 
##Installation##

Run the command below to install via Composer

```shell
composer require scarletspruce/email-validator "dev-master"
```

##Getting Started##
`EmailValidator` requires you to decide which (or combination of them) sanitize/s strategy/ies you'd like to follow for each [sanitize](#available-sanitizers).

A basic example with the common sanitize
```php
<?php

use ScarletSpruce\EmailSanitizer\EmailSanitize;
use \ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers\CommonSanitizer;

$sanitizer = new EmailSanitize();
$email = $sanitizer->sanitize("example@example.com", new CommonSanitizer());
```


###Available sanitizers###

1. [AtSanitizer](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/AtSanitizer.php)
2. [BadCharactersSanitizer](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/BadCharactersSanitizer.php)
3. [CommonSanitizer](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/CommonSanitizer.php)
4. [DomainIncorrectSanitizer](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/DomainIncorrectSanitizer.php)
5. [DomainSanitizer](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/DomainSanitizer.php)
6. [DotsSanitizer](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/DotsSanitizer.php)
7. [LocalSanitizer](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/LocalSanitizer.php)
8. [MultipleEmailSanitizerWithAnd](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/Sanitizers/MultipleEmailSanitizerWithAnd.php)
6. [Your own sanitizer](#how-to-extend)

`MultipleEmailSanitizerWithAnd`

It is a sanitize that operates over other snitizes performing a logical and (&&) over the result of each sanitize.

```php
<?php

use ScarletSpruce\EmailSanitizer\EmailSanitize;
use \ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers\MultipleEmailSanitizerWithAnd;
use \ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers\CommonSanitizer;
use \ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers\AtSanitizer;

$validator = new EmailSanitize();
$multipleSanitizers = new MultipleEmailSanitizerWithAnd([
    new CommonSanitizer(),
    new AtSanitizer()
]);
$email = $validator->sanitize("example@example.com", $multipleSanitizers);
```

###How to extend###

It's easy! You just need to extend [EmailSanitizerInterface](https://github.com/scarletspruce/EmailValidator/blob/master/EmailSanitizer/Sanitize/EmailSanitizerInterface.php) and you can use your own sanitizer.


##Other Contributors##


* Eduardo Gulias Davis [@egulias](https://github.com/egulias):      	PHP Email validator library used to get email parts

##License##
Released under the MIT License attached with this code.

