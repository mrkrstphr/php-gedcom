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

use PhpGedcom\Record\Fam\Even\Addr;
use PhpGedcom\Record\Fam\Even\Husb;
use PhpGedcom\Record\Fam\Even\Plac;
use PhpGedcom\Record\Fam\Even\Wife;
use PhpGedcom\Record\NoteableTrait;
use PhpGedcom\Record\ObjectableTrait;
use PhpGedcom\Record\SourceableTrait;

/**
 * Class Even
 * @package PhpGedcom\Record\Fam
 */
class Even extends \PhpGedcom\Record
{
    use NoteableTrait;
    use ObjectableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var Plac
     */
    protected $plac;

    /**
     * @var string
     */
    protected $caus;

    /**
     * @var integer
     */
    protected $age;

    /**
     * @var Addr
     */
    protected $addr;

    /**
     * @var array
     */
    protected $phon = array();

    /**
     * @var string
     */
    protected $agnc;

    /**
     * @var Husb
     */
    protected $husb;

    /**
     * @var Wife
     */
    protected $wife;

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @param \PhpGedcom\Record\Fam\Even\Plac $plac
     */
    public function setPlac($plac)
    {
        $this->plac = $plac;
    }

    /**
     * @return \PhpGedcom\Record\Fam\Even\Plac
     */
    public function getPlac()
    {
        return $this->plac;
    }

    /**
     * @param string $caus
     */
    public function setCaus($caus)
    {
        $this->caus = $caus;
    }

    /**
     * @return string
     */
    public function getCaus()
    {
        return $this->caus;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param \PhpGedcom\Record\Fam\Even\Addr $addr
     */
    public function setAddr($addr)
    {
        $this->addr = $addr;
    }

    /**
     * @return \PhpGedcom\Record\Fam\Even\Addr
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * @param array $phon
     */
    public function setPhon($phon)
    {
        $this->phon = $phon;
    }

    /**
     * @param Phon $phon
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
     * @param string $agnc
     */
    public function setAgnc($agnc)
    {
        $this->agnc = $agnc;
    }

    /**
     * @return string
     */
    public function getAgnc()
    {
        return $this->agnc;
    }

    /**
     * @param \PhpGedcom\Record\Fam\Even\Husb $husb
     */
    public function setHusb($husb)
    {
        $this->husb = $husb;
    }

    /**
     * @return \PhpGedcom\Record\Fam\Even\Husb
     */
    public function getHusb()
    {
        return $this->husb;
    }

    /**
     * @param \PhpGedcom\Record\Fam\Even\Wife $wife
     */
    public function setWife($wife)
    {
        $this->wife = $wife;
    }

    /**
     * @return \PhpGedcom\Record\Fam\Even\Wife
     */
    public function getWife()
    {
        return $this->wife;
    }
}
