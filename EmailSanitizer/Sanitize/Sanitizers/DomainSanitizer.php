<?php

namespace ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers;

use ScarletSpruce\EmailSanitizer\Sanitize\Traits\EmailBuilderTrait;
use ScarletSpruce\EmailSanitizer\Sanitize\Traits\EmailInfoTrait;

/**
 * Class DomainSanitizer
 * @package ScarletSpruce\EmailSanitizer\Sanitize\Sanitizers
 */
class DomainSanitizer extends AbstractSanitizer
{
    use EmailInfoTrait;
    use EmailBuilderTrait;

    private $cleanDomainRules = [
        [
            'pattern' => '#^(\w+)(\.)(кг|ry|к|pu|r|rui)$#ui',
            'replacement' => '$1$2ru',
        ],
        [
            'pattern' => '#^(\w+)(\.)(c)$#ui',
            'replacement' => '$1$2com',
        ],
        [
            'pattern' => '#^(\w+)(\.)(n|ne)$#ui',
            'replacement' => '$1$2net',
        ],
        [
            'pattern' => '#^(yandex(?:ru|\.|))?$#ui',
            'replacement' => 'yandex.ru',
        ],
        [
            'pattern' => '#^(facebook|hotmail|outlook|gmail|yahoo|live|yandex|icloud|mail)(\.)(co|c|)$#ui',
            'replacement' => '$1$2com',
        ],
        [
            'pattern' => '#^(ma[ij]l(?:ru|\.|))$#ui',
            'replacement' => 'mail.ru',
        ],
        [
            'pattern' => '#^([a-z][a-z1-9]+)-ru$#ui',
            'replacement' => '$1.ru',
        ],
        [
            'pattern' => '#^(majl\.ru)$#ui',
            'replacement' => 'mail.ru',
        ],
        [
            'pattern' => '#[^-\da-z.]#ui',
            'replacement' => '',
        ],

    ];

    public function __construct(array $cleanDomainRules = [])
    {
        foreach ($cleanDomainRules as $key => $rule) {
            if (is_array($rule) && array_key_exists('pattern', $rule) && array_key_exists('replacement', $rule)) {
                continue;
            }
            unset($cleanDomainRules[$key]);
        }

        if ($cleanDomainRules) {
            $this->cleanDomainRules = array_merge($this->cleanDomainRules, $cleanDomainRules);
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

        foreach ($this->cleanDomainRules as $rule) {
            $domainPart = preg_replace($rule['pattern'], $rule['replacement'], $domainPart);
        }

        return $this->buildEmail($this->getLocalPart(), $domainPart);
    }


}
