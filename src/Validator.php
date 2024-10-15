<?php

namespace Staplescheck;

use InvalidArgumentException;

class Validator
{
    /**
     * @var string
     */
    private $staples = '';

    /**
     * @var bool|null
     */
    private $isValid;

    public function __construct(string $staples)
    {
        $this->staples = $staples;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if (is_null($this->isValid)) {
            $this->isValid = $this->checkIsValid($this->staples);
        }

        return $this->isValid;
    }

    /**
     * @param string $staples
     * @return bool
     */
    private function checkIsValid(string $staples): bool
    {
        $openCnt = 0;
        $backSlash = false;

        foreach (str_split($staples) as $staple) {
            switch ($staple) {
                case '(':
                    $openCnt++;
                    break;

                case ')':
                    if (--$openCnt < 0) {
                        return false;
                    }

                    break;
                case ' ':
                case ',':
                case '\\':
                    break;

                case "\n":
                case "\t":
                case "\r":
                    break;
                case 'n':
                case 't':
                case 'r':
                    if (!$backSlash) {
                        $this->exception();
                    }

                    break;

                default:
                    $this->exception();
            }

            $backSlash = ($staple === '\\');
        }

        return ($openCnt === 0);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    private function exception(): void
    {
        throw new InvalidArgumentException('invalid symbol');
    }
}