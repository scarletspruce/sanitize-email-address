<?php
namespace ScarletSpruce\EmailSanitizer\Sanitize\Traits;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\EmailParser;
use Exception;

trait EmailInfoTrait
{

    protected $email;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param $email
     * @return string
     */
    public function getDomainPart()
    {
        $parts = $this->getEmailParts();
        return $parts['domain'];
    }

    /**
     * @param $email
     * @return string
     */
    public function getLocalPart()
    {
        $parts = $this->getEmailParts();
        return $parts['local'];
    }

    /**
     * @param $email
     * @return string
     */
    public function getFirstLocalChar()
    {
        return mb_substr($this->getEmailParts(), 0, 1);
    }

    /**
     * @param $email
     *
     * @return array
     */
    protected function getEmailParts()
    {
        $parser = new EmailParser(new EmailLexer());
        try {
            $result = $parser->parse($this->email);
        } catch (Exception $e) {
            $result = [
                'local'  => $this->getSimpleEmailPart($this->email, true),
                'domain' => $this->getSimpleEmailPart($this->email),
            ];
        }

        return $result;
    }

    /**
     * Get part of email address
     *
     * @param bool $local Local part
     *
     * @return string
     */
    protected static function getSimpleEmailPart($email, $local = false)
    {
        if (false === mb_strpos($email, '@')) {
            return $email;
        }

        return ltrim(mb_strrchr($email, '@', (bool)$local), '@');
    }
}