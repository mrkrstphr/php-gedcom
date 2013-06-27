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

namespace PhpGedcom\Record;

use PhpGedcom\Record;
use PhpGedcom\Record\Repo\Phon as PhonX;
use PhpGedcom\Record\Repo\Refn as RefnX;

/**
 * Class Repo
 * @package PhpGedcom\Record
 */
class Repo extends Record
{
    use NoteableTrait;

    /**
     * @var string
     */
    protected $repo;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Addr
     */
    protected $addr;

    /**
     * @var string
     */
    protected $rin;

    /**
     * @var Chan
     */
    protected $chan;

    /**
     * @var array
     * @of Phon
     */
    protected $phon = array();

    /**
     * @var array
     * @of RefnX
     */
    protected $refn = array();

    /**
     * @param PhonX $phon
     * @return Repo
     */
    public function addPhon(PhonX $phon)
    {
        $this->phon[] = $phon;
        return $this;
    }

    /**
     * @return array
     */
    public function getPhon()
    {
        return $this->phon;
    }

    /**
     * @param RefnX $refn
     * @return $this
     */
    public function addRefn(RefnX $refn)
    {
        $this->refn[] = $refn;
        return $this;
    }

    /**
     * @return array
     */
    public function getRefn()
    {
        return $this->refn;
    }

    /**
     * @param string $repo
     * @return Repo
     */
    public function setRepo($repo)
    {
        $this->repo = $repo;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param string $name
     * @return Repo
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \PhpGedcom\Record\Addr $addr
     * @return Repo
     */
    public function setAddr($addr)
    {
        $this->addr = $addr;
        return $this;
    }

    /**
     * @return \PhpGedcom\Record\Addr
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * @param string $rin
     * @return Repo
     */
    public function setRin($rin)
    {
        $this->rin = $rin;
        return $this;
    }

    /**
     * @return string
     */
    public function getRin()
    {
        return $this->rin;
    }

    /**
     * @param \PhpGedcom\Record\Chan $chan
     * @return Repo
     */
    public function setChan($chan)
    {
        $this->chan = $chan;
        return $this;
    }

    /**
     * @return \PhpGedcom\Record\Chan
     */
    public function getChan()
    {
        return $this->chan;
    }
}
