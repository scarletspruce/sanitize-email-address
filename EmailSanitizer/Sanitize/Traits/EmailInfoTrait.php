<?php
namespace ScarletSpruce\EmailSanitizer\Sanitize\Traits;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\EmailParser;
use Exception;
use ScarletSpruce\EmailSanitizer\Exception\InvalidEmail;

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
            throw new InvalidEmail();
        }

        return $result;
    }


}