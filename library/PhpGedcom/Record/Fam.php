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
use PhpGedcom\Record\Fam\Even;
use PhpGedcom\Record\Fam\Slgs;

/**
 * Class Fam
 * @package PhpGedcom\Record
 */
class Fam extends Record
{
    use NoteableTrait;
    use ObjectableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $id;
    
    /**
     * @var Chan
     */
    protected $chan;
    
    /**
     * @var string
     */
    protected $husb;
    
    /**
     * @var string
     */
    protected $wife;
    
    /**
     * @var integer
     */
    protected $nchi;
    
    /**
     * @var array
     */
    protected $chil = array();
    
    /**
     * @var array
     */
    protected $even = array();
    
    /**
     * @var array
     */
    protected $slgs = array();
    
    /**
     * @var array
     */
    protected $subm = array();
    
    /**
     * @var array
     */
    protected $refn = array();
    
    /**
     * @var string
     */
    protected $rin;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $chan
     */
    public function setChan($chan)
    {
        $this->chan = $chan;
    }

    /**
     * @return mixed
     */
    public function getChan()
    {
        return $this->chan;
    }

    /**
     * @param mixed $husb
     */
    public function setHusb($husb)
    {
        $this->husb = $husb;
    }

    /**
     * @return mixed
     */
    public function getHusb()
    {
        return $this->husb;
    }

    /**
     * @param mixed $wife
     */
    public function setWife($wife)
    {
        $this->wife = $wife;
    }

    /**
     * @return mixed
     */
    public function getWife()
    {
        return $this->wife;
    }

    /**
     * @param mixed $nchi
     */
    public function setNchi($nchi)
    {
        $this->nchi = $nchi;
    }

    /**
     * @return array
     */
    public function getNchi()
    {
        return $this->nchi;
    }

    /**
     * @param array $chil
     */
    public function setChil($chil)
    {
        $this->chil = $chil;
    }

    /**
     * @param string $chil
     */
    public function addChil($chil)
    {
        $this->chil[] = $chil;
    }

    /**
     * @return mixed
     */
    public function getChil()
    {
        return $this->chil;
    }

    /**
     * @param mixed $even
     */
    public function setEven($even)
    {
        $this->even = $even;
    }

    /**
     * @param Even $even
     */
    public function addEven($even)
    {
        $this->even[] = $even;
    }

    /**
     * @return mixed
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * @param array $slgs
     */
    public function setSlgs($slgs)
    {
        $this->slgs = $slgs;
    }

    /**
     * @param Slgs $slgs
     */
    public function addSlgs($slgs)
    {
        $this->slgs[] = $slgs;
    }

    /**
     * @return array
     */
    public function getSlgs()
    {
        return $this->slgs;
    }

    /**
     * @param mixed $subm
     */
    public function setSubm($subm)
    {
        $this->subm = $subm;
    }

    /**
     * @param string $subm
     */
    public function addSubm($subm)
    {
        $this->subm[] = $subm;
    }

    /**
     * @return mixed
     */
    public function getSubm()
    {
        return $this->subm;
    }

    /**
     * @param mixed $refn
     */
    public function setRefn($refn)
    {
        $this->refn = $refn;
    }

    /**
     * @param Refn $refn
     */
    public function addRefn(Refn $refn)
    {
        $this->refn[] = $refn;
    }

    /**
     * @return mixed
     */
    public function getRefn()
    {
        return $this->refn;
    }

    /**
     * @param mixed $rin
     */
    public function setRin($rin)
    {
        $this->rin = $rin;
    }

    /**
     * @return mixed
     */
    public function getRin()
    {
        return $this->rin;
    }
}
