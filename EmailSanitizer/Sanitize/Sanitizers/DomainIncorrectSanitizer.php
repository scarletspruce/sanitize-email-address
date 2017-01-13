<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use ScarletSpruce\EmailSanitizer\Sanitize\Traits\EmailBuilderTrait;
use ScarletSpruce\EmailSanitizer\Sanitize\Traits\EmailInfoTrait;

/**
 * Class DomainIncorrectSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class DomainIncorrectSanitizer extends AbstractSanitizer
{
    use EmailInfoTrait;
    use EmailBuilderTrait;

    /**
     * Incorrect domain names
     *
     * @todo-dev Move to the config
     * @var array
     */
    private $incorrectDomains = [
        'hotmal.co'   => 'hotmail.com',
        'hotmil.co'   => 'hotmail.com',
        'homail.com'  => 'hotmail.com',
        'gmai.com'    => 'gmail.com',
        'gmail.comra' => 'gmail.com',
        'gamil.com'   => 'gmail.com',
        'outloo.com'  => 'outlook.com',
        'mail.'       => 'mail.ru',
        'mail.rt'     => 'mail.ru',
        'mail.rui'    => 'mail.ru',
        'майл.р'      => 'mail.ru',
        'майл.ру'     => 'mail.ru',
        'маилру'      => 'mail.ru',
        'maill.ru'    => 'mail.ru',
        'meil.ru'     => 'mail.ru',
        'indox.ru'    => 'inbox.ru',
        'yndex.ru'    => 'yandex.ru',
        'yand.ru'     => 'yandex.ru',
        'yande.ru'    => 'yandex.ru',
        'yan.ru'      => 'yandex.ru',
        'comcast.ent' => 'comcast.net',
    ];

    private $incorrectFirstLevelDomains = [
        'edy' => 'edu',
        'con' => 'com',
    ];

    public function __construct(array $incorrectDomains = [], array $incorrectFirstLevelDomains = [])
    {
        if ($incorrectDomains) {
            $this->incorrectDomains = array_merge($this->incorrectDomains, $incorrectDomains);
        }

        if ($incorrectFirstLevelDomains) {
            $this->incorrectFirstLevelDomains = array_merge($this->incorrectFirstLevelDomains, $incorrectFirstLevelDomains);
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        $this->setEmail($email);
        $domainPart = $this->getDomainPart();

        // isset is faster than array_key_exists also because is a language construct, not a function
        if (isset($this->incorrectDomains[$domainPart])) {
            $domainPart = $this->incorrectDomains[$domainPart];
        }

        $parts = explode('.', $domainPart);
        $last = array_pop($parts);
        if (isset($this->incorrectFirstLevelDomains[$last])) {
            $parts[] = $this->incorrectFirstLevelDomains[$last];
            $domainPart = implode('.', $parts);
        }

        return $this->buildEmail($this->getLocalPart(), $domainPart);
    }


}
