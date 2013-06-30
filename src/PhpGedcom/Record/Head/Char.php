<?php
/**
 * php-gedcom
 *
 * php-gedcom is a library for parsing, manipulating, importing and exporting
 * GEDCOM 5.5 files in PHP 5.3+.
 *
 * @author          Kristopher Wilson <kristopherwilson@gmail.com>
 * @copyright       Copyright (c) 2010-2013, Kristopher Wilson
 * @package         php-gedcom 
 * @license         GPL-3.0
 * @link            http://github.com/mrkrstphr/php-gedcom
 */
namespace PhpGedcom\Record\Head;

/**
 *
 */
class Char extends \PhpGedcom\Record
{
    /**
     * @var string
     */
    protected $char;

    /**
     * @var string
     */
    protected $vers;

    /**
     * @param string $char
     */
    public function setChar($char)
    {
        $this->char = $char;
    }

    /**
     * @return string
     */
    public function getChar()
    {
        return $this->char;
    }

    /**
     * @param string $vers
     */
    public function setVers($vers)
    {
        $this->vers = $vers;
    }

    /**
     * @return string
     */
    public function getVers()
    {
        return $this->vers;
    }
}
