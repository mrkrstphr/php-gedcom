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
use PhpGedcom\Record\Fam\Anul;
use PhpGedcom\Record\Fam\Cens;
use PhpGedcom\Record\Fam\Div;
use PhpGedcom\Record\Fam\Divf;
use PhpGedcom\Record\Fam\Even;
use PhpGedcom\Record\Fam\Enga;
use PhpGedcom\Record\Fam\Marb;
use PhpGedcom\Record\Fam\Marc;
use PhpGedcom\Record\Fam\Marl;
use PhpGedcom\Record\Fam\Marr;
use PhpGedcom\Record\Fam\Mars;
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
    protected $fam;
    
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
     * Generic event type.
     * @var array
     * @of Even
     */
    protected $even = array();

    /**
     * Event type.
     * @var array
     * @of Anul
     */
    protected $anul = array();

    /**
     * Event type.
     * @var array
     * @of Cens
     */
    protected $cens = array();

    /**
     * Event type.
     * @var array
     * @of Div
     */
    protected $div = array();

    /**
     * Event type.
     * @var array
     * @of Divf
     */
    protected $divf = array();

    /**
     * Event type.
     * @var array
     * @of Enga
     */
    protected $enga = array();

    /**
     * Event type.
     * @var array
     * @of Marr
     */
    protected $marr = array();

    /**
     * Event type.
     * @var array
     * @of Marb
     */
    protected $marb = array();

    /**
     * Event type.
     * @var array
     * @of Marc
     */
    protected $marc = array();

    /**
     * Event type.
     * @var array
     * @of Marl
     */
    protected $marl = array();

    /**
     * Event type.
     * @var array
     * @of Mars
     */
    protected $mars = array();

    /**
     * @var array
     * @of Slgs
     */
    protected $slgs = array();
    
    /**
     * @var array
     */
    protected $subm = array();
    
    /**
     * @var array
     * @of AbstractRefn
     */
    protected $refn = array();
    
    /**
     * @var string
     */
    protected $rin;

    /**
     * @param string $fam
     */
    public function setFam($fam)
    {
        $this->fam = $fam;
    }

    /**
     * @return string
     */
    public function getFam()
    {
        return $this->fam;
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
     * @param array $even
     */
    public function setEven(array $even)
    {
        $this->even = $even;
    }

    /**
     * @param Even $even
     */
    public function addEven(Even $even)
    {
        $this->even[] = $even;
    }

    /**
     * @return array
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * Gets a super array of all events stored for this family.
     *
     * @return mixed
     */
    public function getEvents()
    {
        // TODO FIXME
    }

    /**
     * @param array $anul
     */
    public function setAnul($anul)
    {
        $this->anul = $anul;
    }

    /**
     * @param Anul $anul
     */
    public function addAnul(Anul $anul)
    {
        $this->anul[] = $anul;
    }

    /**
     * @return array
     */
    public function getAnul()
    {
        return $this->anul;
    }

    /**
     * @param array $cens
     */
    public function setCens($cens)
    {
        $this->cens = $cens;
    }

    /**
     * @param Cens $cens
     */
    public function addCens(Cens $cens)
    {
        $this->cens[] = $cens;
    }

    /**
     * @return array
     */
    public function getCens()
    {
        return $this->cens;
    }

    /**
     * @param array $div
     */
    public function setDiv($div)
    {
        $this->div = $div;
    }

    /**
     * @param Div $div
     */
    public function addDiv(Div $div)
    {
        $this->div[] = $div;
    }

    /**
     * @return array
     */
    public function getDiv()
    {
        return $this->div;
    }

    /**
     * @param array $divf
     */
    public function setDivf($divf)
    {
        $this->divf = $divf;
    }

    /**
     * @param Divf $divf
     */
    public function addDivf(Divf $divf)
    {
        $this->divf[] = $divf;
    }

    /**
     * @return array
     */
    public function getDivf()
    {
        return $this->divf;
    }

    /**
     * @param array $enga
     */
    public function setEnga($enga)
    {
        $this->enga = $enga;
    }

    /**
     * @param Enga $enga
     */
    public function addEnga(Enga $enga)
    {
        $this->enga[] = $enga;
    }

    /**
     * @return array
     */
    public function getEnga()
    {
        return $this->enga;
    }

    /**
     * @param array $marb
     */
    public function setMarb($marb)
    {
        $this->marb = $marb;
    }

    /**
     * @param Marb $marb
     */
    public function addMarb(Marb $marb)
    {
        $this->marb[] = $marb;
    }

    /**
     * @return array
     */
    public function getMarb()
    {
        return $this->marb;
    }

    /**
     * @param array $marc
     */
    public function setMarc($marc)
    {
        $this->marc = $marc;
    }

    /**
     * @param Marc $marc
     */
    public function addMarc(Marc $marc)
    {
        $this->marc[] = $marc;
    }

    /**
     * @return array
     */
    public function getMarc()
    {
        return $this->marc;
    }

    /**
     * @param array $marl
     */
    public function setMarl($marl)
    {
        $this->marl = $marl;
    }

    /**
     * @param Marl $marl
     */
    public function addMarl(Marl $marl)
    {
        $this->marl[] = $marl;
    }

    /**
     * @return array
     */
    public function getMarl()
    {
        return $this->marl;
    }

    /**
     * @param array $marr
     */
    public function setMarr($marr)
    {
        $this->marr = $marr;
    }

    /**
     * @param Marr $marr
     */
    public function addMarr(Marr $marr)
    {
        $this->marr[] = $marr;
    }

    /**
     * @return array
     */
    public function getMarr()
    {
        return $this->marr;
    }

    /**
     * @param array $mars
     */
    public function setMars($mars)
    {
        $this->mars = $mars;
    }

    /**
     * @param Mars $mars
     */
    public function addMars(Mars $mars)
    {
        $this->mars[] = $mars;
    }

    /**
     * @return array
     */
    public function getMars()
    {
        return $this->mars;
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
     * @param array $subm
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
     * @return array
     */
    public function getSubm()
    {
        return $this->subm;
    }

    /**
     * @param array $refn
     */
    public function setRefn(array $refn)
    {
        $this->refn = $refn;
    }

    /**
     * @param AbstractRefn $refn
     */
    public function addRefn(AbstractRefn $refn)
    {
        $this->refn[] = $refn;
    }

    /**
     * @return array
     */
    public function getRefn()
    {
        return $this->refn;
    }

    /**
     * @param string $rin
     */
    public function setRin($rin)
    {
        $this->rin = $rin;
    }

    /**
     * @return string
     */
    public function getRin()
    {
        return $this->rin;
    }
}
