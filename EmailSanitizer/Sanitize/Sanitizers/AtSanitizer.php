<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use Egulias\EmailValidator\Exception\NoDomainPart;
use ScarletSpruce\EmailSanitizer\Sanitize\EmailSanitizerInterface;

/**
 * Class DotsSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class AtSanitizer extends AbstractSanitizer
{

    /**
     * Domains for insert missed @
     *
     * @var array
     */
    private $atDomains = [
        'mail.ru',
        'list.ru',
        'bk.ru',
        'inbox.ru',
        'yandex.com',
        'yandex.ru',
        'ya.ru',
        'gmail.com',
        'yahoo.com',
        'hotmail.com',
        'ukr.net',
        'facebook.com',
        'pdffiller.com',
    ];

    public function __construct(array $atDomains = [])
    {
        if ($atDomains) {
            $this->atDomains = array_merge($this->atDomains, $atDomains);
        }
    }



    /**
     * Fix missed @ fo known domains.
     * @param $email
     * @return bool
     */
    public function sanitize($email)
    {
        if (false === mb_strpos($email, '@')) {

            foreach ($this->atDomains as $domain) {
                $domainPart = mb_strrchr($email, $domain);

                if ($domainPart == $domain) {
                    $namePart = mb_substr($email, 0, mb_strlen($email) - mb_strlen($domainPart));
                    $email = $namePart . '@' . $domainPart;
                    break;
                }
            }

            if (false === mb_strpos($email, '@')) {
                $this->warnings[] = new NoDomainPart();
            }
        }

        return $email;
    }
}
