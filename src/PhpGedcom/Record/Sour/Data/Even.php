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

namespace PhpGedcom\Record\Sour\Data;

/**
 * Class Even
 * @package PhpGedcom\Record\Sour\Data
 */
class Even extends \PhpGedcom\Record
{
    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $plac;

    /**
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $plac
     * @return $this
     */
    public function setPlac($plac)
    {
        $this->plac = $plac;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlac()
    {
        return $this->plac;
    }
}
