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

namespace PhpGedcom\Record\Fam;

use PhpGedcom\Record\NoteableTrait;
use PhpGedcom\Record\SourceableTrait;
use PhpGedcom\Record;

/**
 * Class Slgs
 * @package PhpGedcom\Record\Fam
 */
class Slgs extends Record
{
    use NoteableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $stat;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $plac;

    /**
     * @var string
     */
    protected $temp;

    /**
     * @param string $stat
     */
    public function setStat($stat)
    {
        $this->stat = $stat;
    }

    /**
     * @return string
     */
    public function getStat()
    {
        return $this->stat;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     */
    public function setPlac($plac)
    {
        $this->plac = $plac;
    }

    /**
     * @return string
     */
    public function getPlac()
    {
        return $this->plac;
    }

    /**
     * @param string $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return string
     */
    public function getTemp()
    {
        return $this->temp;
    }
}
