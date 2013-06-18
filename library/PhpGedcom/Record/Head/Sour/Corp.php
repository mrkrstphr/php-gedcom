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

namespace PhpGedcom\Record\Head\Sour;

/**
 * Class Corp
 * @package PhpGedcom\Record\Head\Sour
 */
class Corp extends \PhpGedcom\Record
{
    /**
     * @var string
     */
    protected $corp;

    /**
     * @var \PhpGedcom\Record\Addr
     */
    protected $addr;

    /**
     * @var array
     */
    protected $phon = array();
    
    /**
     * @var string
     */
    public function addPhon($phon)
    {
        $this->phon[] = $phon;
    }

    /**
     * @return array
     */
    public function getPhon()
    {
        return $this->phon;
    }

    /**
     * @param string $corp
     */
    public function setCorp($corp)
    {
        $this->corp = $corp;
    }

    /**
     * @return string
     */
    public function getCorp()
    {
        return $this->corp;
    }

    /**
     * @param \PhpGedcom\Record\Addr $addr
     */
    public function setAddr($addr)
    {
        $this->addr = $addr;
    }

    /**
     * @return \PhpGedcom\Record\Addr
     */
    public function getAddr()
    {
        return $this->addr;
    }
}
