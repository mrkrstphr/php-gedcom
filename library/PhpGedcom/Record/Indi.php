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
use PhpGedcom\Record\ObjeRef;
use PhpGedcom\Record\SourRef;

/**
 * Class Indi
 * @package PhpGedcom\Record
 */
class Indi extends Record
{
    use NoteableTrait;
    use ObjectableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $id;
    
    /**
     * @var Indi\Chan
     */
    protected $chan;
    
    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Attr
     */
    protected $attr = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Cast
     */
    protected $cast = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Dscr
     */
    protected $dscr = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Educ
     */
    protected $educ = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Idno
     */
    protected $idno = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Nati
     */
    protected $nati = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Nchi
     */
    protected $nchi = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Nmr
     */
    protected $nmr = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Occu
     */
    protected $occu = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Prop
     */
    protected $prop = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Reli
     */
    protected $reli = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Resi
     */
    protected $resi = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Ssn
     */
    protected $ssn = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Titl
     */
    protected $titl = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Even
     */
    protected $even = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Adop
     */
    protected $adop = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Birt
     */
    protected $birt = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Bapm
     */
    protected $bapm = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Barm
     */
    protected $barm = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Basm
     */
    protected $basm = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Bles
     */
    protected $bles = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Buri
     */
    protected $buri = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Cens
     */
    protected $cens = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Chr
     */
    protected $chr = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Chra
     */
    protected $chra = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Conf
     */
    protected $conf = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Crem
     */
    protected $crem = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Deat
     */
    protected $deat = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Emig
     */
    protected $emig = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Fcom


     */
    protected $fcom = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Grad
     */
    protected $grad = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Immi
     */
    protected $immi = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Natu
     */
    protected $natu = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Ordn
     */
    protected $ordn = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Reti
     */
    protected $reti = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Prob
     */
    protected $prob = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Will
     */
    protected $will = array();

    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Name
     */
    protected $name = array();
    
    /**
     * @var array
     */
    protected $alia = array();
    
    /**
     * @var string
     */
    protected $sex;
    
    /**
     * @var string
     */
    protected $rin;
    
    /**
     * @var string
     */
    protected $resn;
    
    /**
     * @var string
     */
    protected $rfn;
    
    /**
     * @var string
     */
    protected $afn;
    
    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Fams
     */
    protected $fams = array();
    
    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Famc
     */
    protected $famc = array();
    
    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Asso
     */
    protected $asso = array();
    
    /**
     * @var array
     */
    protected $subm = array();
    
    /**
     * @var array
     */
    protected $anci = array();
    
    /**
     * @var array
     */
    protected $desi = array();
    
    /**
     * @var array
     * @of \PhpGedcom\Record\Indi\Refn
     */
    protected $refn = array();
    
    /**
     * @var Indi\Bapl
     */
    protected $bapl;
    
    /**
     * @var Indi\Conl
     */
    protected $conl;
    
    /**
     * @var Indi\Endl
     */
    protected $endl;
    
    /**
     * @var Indi\Slgc
     */
    protected $slgc;

    /**
     * @param string $id
     * @return Indi
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Indi\Name $name
     * @return Indi
     */
    public function addName(Indi\Name $name)
    {
        $this->name[] = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Indi\Attr $attr
     * @return Indi
     */
    public function addAttr(Indi\Attr $attr)
    {
        $this->attr[] = $attr;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttr()
    {
        return $this->attr;
    }

    /**
     * @param array $cast
     * @return $this
     */
    public function setCast($cast)
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * @param Indi\Cast $cast
     * @return $this
     */
    public function addCast(Indi\Cast $cast)
    {
        $this->cast[] = $cast;
        return $this;
    }

    /**
     * @return array
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @param array $dscr
     * @return $this
     */
    public function setDscr($dscr)
    {
        $this->dscr = $dscr;
        return $this;
    }

    /**
     * @param Indi\Dscr $dscr
     * @return $this
     */
    public function addDscr(Indi\Dscr $dscr)
    {
        $this->dscr[] = $dscr;
        return $this;
    }

    /**
     * @return array
     */
    public function getDscr()
    {
        return $this->dscr;
    }

    /**
     * @param array $educ
     * @return $this
     */
    public function setEduc($educ)
    {
        $this->educ = $educ;
        return $this;
    }

    /**
     * @param Indi\Educ $educ
     * @return $this
     */
    public function addEduc(Indi\Educ $educ)
    {
        $this->educ[] = $educ;
        return $this;
    }

    /**
     * @return array
     */
    public function getEduc()
    {
        return $this->educ;
    }

    /**
     * @param array $idno
     * @return $this
     */
    public function setIdno($idno)
    {
        $this->idno = $idno;
        return $this;
    }

    /**
     * @param Indi\Idno $idno
     * @return $this
     */
    public function addIdno(Indi\Idno $idno)
    {
        $this->idno[] = $idno;
        return $this;
    }

    /**
     * @return array
     */
    public function getIdno()
    {
        return $this->idno;
    }

    /**
     * @param array $nati
     * @return $this
     */
    public function setNati($nati)
    {
        $this->nati = $nati;
        return $this;
    }

    /**
     * @param Indi\Nati $nati
     * @return $this
     */
    public function addNati(Indi\Nati $nati)
    {
        $this->nati[] = $nati;
        return $this;
    }

    /**
     * @return array
     */
    public function getNati()
    {
        return $this->nati;
    }

    /**
     * @param array $nchi
     * @return $this
     */
    public function setNchi($nchi)
    {
        $this->nchi = $nchi;
        return $this;
    }

    /**
     * @param Indi\Nchi $nchi
     * @return $this
     */
    public function addNchi(Indi\Nchi $nchi)
    {
        $this->nchi[] = $nchi;
        return $this;
    }

    /**
     * @return array
     */
    public function getNchi()
    {
        return $this->nchi;
    }

    /**
     * @param array $nmr
     * @return $this
     */
    public function setNmr($nmr)
    {
        $this->nmr = $nmr;
        return $this;
    }

    /**
     * @param Indi\Nmr $nmr
     * @return $this
     */
    public function addNmr(Indi\Nmr $nmr)
    {
        $this->nmr[] = $nmr;
        return $this;
    }

    /**
     * @return array
     */
    public function getNmr()
    {
        return $this->nmr;
    }

    /**
     * @param array $occu
     * @return $this
     */
    public function setOccu($occu)
    {
        $this->occu = $occu;
        return $this;
    }

    /**
     * @param Indi\Occu $occu
     * @return $this
     */
    public function addOccu(Indi\Occu $occu)
    {
        $this->occu[] = $occu;
        return $this;
    }

    /**
     * @return array
     */
    public function getOccu()
    {
        return $this->occu;
    }

    /**
     * @param array $prop
     * @return $this
     */
    public function setProp($prop)
    {
        $this->prop = $prop;
        return $this;
    }

    /**
     * @param Indi\Prop $prop
     * @return $this
     */
    public function addProp(Indi\Prop $prop)
    {
        $this->prop[] = $prop;
        return $this;
    }

    /**
     * @return array
     */
    public function getProp()
    {
        return $this->prop;
    }

    /**
     * @param array $reli
     * @return $this
     */
    public function setReli($reli)
    {
        $this->reli = $reli;
        return $this;
    }

    /**
     * @param Indi\Reli $reli
     * @return $this
     */
    public function addReli(Indi\Reli $reli)
    {
        $this->reli[] = $reli;
        return $this;
    }

    /**
     * @return array
     */
    public function getReli()
    {
        return $this->reli;
    }

    /**
     * @param array $resi
     * @return $this
     */
    public function setResi($resi)
    {
        $this->resi = $resi;
        return $this;
    }

    /**
     * @param Indi\Resi $resi
     * @return $this
     */
    public function addResi(Indi\Resi $resi)
    {
        $this->resi[] = $resi;
        return $this;
    }

    /**
     * @return array
     */
    public function getResi()
    {
        return $this->resi;
    }

    /**
     * @param array $ssn
     * @return $this
     */
    public function setSsn($ssn)
    {
        $this->ssn = $ssn;
        return $this;
    }

    /**
     * @param Indi\Ssn $ssn
     * @return $this
     */
    public function addSsn(Indi\Ssn $ssn)
    {
        $this->ssn[] = $ssn;
        return $this;
    }

    /**
     * @return array
     */
    public function getSsn()
    {
        return $this->ssn;
    }

    /**
     * @param array $titl
     * @return $this
     */
    public function setTitl($titl)
    {
        $this->titl = $titl;
        return $this;
    }

    /**
     * @param Indi\Titl $titl
     * @return $this
     */
    public function addTitl(Indi\Titl $titl)
    {
        $this->titl[] = $titl;
        return $this;
    }

    /**
     * @return array
     */
    public function getTitl()
    {
        return $this->titl;
    }

    /**
     * @param Indi\Even $even
     * @return Indi
     */
    public function addEven(Indi\Even $even)
    {
        $this->even[] = $even;
        return $this;
    }

    /**
     * @return array
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * @param array $adop
     * @return $this
     */
    public function setAdop(array $adop)
    {
        $this->adop = $adop;
        return $this;
    }

    /**
     * @param Indi\Adop $adop
     * @return $this
     */
    public function addAdop(Indi\Adop $adop)
    {
        $this->adop[] = $adop;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdop()
    {
        return $this->adop;
    }

    /**
     * @param array $bapm
     * @return $this
     */
    public function setBapm(array $bapm)
    {
        $this->bapm = $bapm;
        return $this;
    }

    /**
     * @param Indi\Bapm $bapm
     * @return $this
     */
    public function addBapm(Indi\Bapm $bapm)
    {
        $this->bapm[] = $bapm;
        return $this;
    }

    /**
     * @return array
     */
    public function getBapm()
    {
        return $this->bapm;
    }

    /**
     * @param array $barm
     * @return $this
     */
    public function setBarm(array $barm)
    {
        $this->barm = $barm;
        return $this;
    }

    /**
     * @param Indi\Barm $barm
     * @return $this
     */
    public function addBarm(Indi\Barm $barm)
    {
        $this->barm[] = $barm;
        return $this;
    }

    /**
     * @return array
     */
    public function getBarm()
    {
        return $this->barm;
    }

    /**
     * @param array $basm
     * @return $this
     */
    public function setBasm(array $basm)
    {
        $this->basm = $basm;
        return $this;
    }

    /**
     * @param Indi\Basm $basm
     * @return $this
     */
    public function addBasm(Indi\Basm $basm)
    {
        $this->basm[] = $basm;
        return $this;
    }

    /**
     * @return array
     */
    public function getBasm()
    {
        return $this->basm;
    }

    /**
     * @param array $birt
     * @return $this
     */
    public function setBirt(array $birt)
    {
        $this->birt = $birt;
        return $this;
    }

    /**
     * @param Indi\Birt $birt
     * @return $this
     */
    public function addBirt(Indi\Birt $birt)
    {
        $this->birt[] = $birt;
        return $this;
    }

    /**
     * @return array
     */
    public function getBirt()
    {
        return $this->birt;
    }

    /**
     * @param array $bles
     * @return $this
     */
    public function setBles($bles)
    {
        $this->bles = $bles;
        return $this;
    }

    /**
     * @param Indi\Bles $bles
     * @return $this
     */
    public function addBles(Indi\Bles $bles)
    {
        $this->bles[] = $bles;
        return $this;
    }

    /**
     * @return array
     */
    public function getBles()
    {
        return $this->bles;
    }

    /**
     * @param array $buri
     * @return $this
     */
    public function setBuri(array $buri)
    {
        $this->buri = $buri;
        return $this;
    }

    /**
     * @param Indi\Buri $buri
     * @return $this
     */
    public function addBuri(Indi\Buri $buri)
    {
        $this->buri[] = $buri;
        return $this;
    }

    /**
     * @return array
     */
    public function getBuri()
    {
        return $this->buri;
    }

    /**
     * @param array $cens
     * @return $this
     */
    public function setCens(array $cens)
    {
        $this->cens = $cens;
        return $this;
    }

    /**
     * @param Indi\Cens $cens
     * @return $this
     */
    public function addCens(Indi\Cens $cens)
    {
        $this->cens[] = $cens;
        return $this;
    }

    /**
     * @return array
     */
    public function getCens()
    {
        return $this->cens;
    }

    /**
     * @param array $chr
     * @return $this
     */
    public function setChr($chr)
    {
        $this->chr = $chr;
        return $this;
    }

    /**
     * @param Indi\Chr $chr
     * @return $this
     */
    public function addChr(Indi\Chr $chr)
    {
        $this->chr[] = $chr;
        return $this;
    }

    /**
     * @return array
     */
    public function getChr()
    {
        return $this->chr;
    }

    /**
     * @param array $chra
     * @return $this
     */
    public function setChra($chra)
    {
        $this->chra = $chra;
        return $this;
    }

    /**
     * @param Indi\Chra $chra
     * @return $this
     */
    public function addChra(Indi\Chra $chra)
    {
        $this->chra[] = $chra;
        return $this;
    }

    /**
     * @return array
     */
    public function getChra()
    {
        return $this->chra;
    }

    /**
     * @param array $conf
     * @return $this
     */
    public function setConf($conf)
    {
        $this->conf = $conf;
        return $this;
    }

    /**
     * @param Indi\Conf $conf
     * @return $this
     */
    public function addConf(Indi\Conf $conf)
    {
        $this->conf[] = $conf;
        return $this;
    }

    /**
     * @return array
     */
    public function getConf()
    {
        return $this->conf;
    }

    /**
     * @param array $crem
     * @return $this
     */
    public function setCrem($crem)
    {
        $this->crem = $crem;
        return $this;
    }

    /**
     * @param Indi\Crem $cem
     * @return $this
     */
    public function addCrem(Indi\Crem $cem)
    {
        $this->crem[] = $cem;
        return $this;
    }

    /**
     * @return array
     */
    public function getCrem()
    {
        return $this->crem;
    }

    /**
     * @param array $deat
     * @return $this
     */
    public function setDeat($deat)
    {
        $this->deat = $deat;
        return $this;
    }

    /**
     * @param Indi\Deat $deat
     * @return $this
     */
    public function addDeat(Indi\Deat $deat)
    {
        $this->deat[] = $deat;
        return $this;
    }

    /**
     * @return array
     */
    public function getDeat()
    {
        return $this->deat;
    }

    /**
     * @param array $emig
     * @return $this
     */
    public function setEmig($emig)
    {
        $this->emig = $emig;
        return $this;
    }

    /**
     * @param Indi\Emig $emig
     * @return $this
     */
    public function addEmig(Indi\Emig $emig)
    {
        $this->emig[] = $emig;
        return $this;
    }

    /**
     * @return array
     */
    public function getEmig()
    {
        return $this->emig;
    }

    /**
     * @param array $fcom
     * @return $this
     */
    public function setFcom($fcom)
    {
        $this->fcom = $fcom;
        return $this;
    }

    /**
     * @param Indi\Fcom $Fcom
     * @return $this
     */
    public function addFcom(Indi\Fcom $fcom)
    {
        $this->fcom[] = $fcom;
        return $this;
    }

    /**
     * @return array
     */
    public function getFcom()
    {
        return $this->fcom;
    }

    /**
     * @param array $grad
     * @return $this
     */
    public function setGrad($grad)
    {
        $this->grad = $grad;
        return $this;
    }

    /**
     * @param Indi\Grad $grad
     * @return $this
     */
    public function addGrad(Indi\Grad $grad)
    {
        $this->grad[] = $grad;
        return $this;
    }

    /**
     * @return array
     */
    public function getGrad()
    {
        return $this->grad;
    }

    /**
     * @param array $immi
     * @return $this
     */
    public function setImmi($immi)
    {
        $this->immi = $immi;
        return $this;
    }

    /**
     * @param Indi\Immi $immi
     * @return $this
     */
    public function addImmi(Indi\Immi $immi)
    {
        $this->immi[] = $immi;
        return $this;
    }

    /**
     * @return array
     */
    public function getImmi()
    {
        return $this->immi;
    }

    /**
     * @param array $natu
     * @return $this
     */
    public function setNatu($natu)
    {
        $this->natu = $natu;
        return $this;
    }

    /**
     * @param Indi\Natu $natu
     * @return $this
     */
    public function addNatu(Indi\Natu $natu)
    {
        $this->natu[] = $natu;
        return $this;
    }

    /**
     * @return array
     */
    public function getNatu()
    {
        return $this->natu;
    }

    /**
     * @param array $ordn
     * @return $this
     */
    public function setOrdn($ordn)
    {
        $this->ordn = $ordn;
        return $this;
    }

    /**
     * @param Indi\Ordn $ordn
     * @return $this
     */
    public function addOrdn(Indi\Ordn $ordn)
    {
        $this->ordn[] = $ordn;
        return $this;
    }

    /**
     * @return array
     */
    public function getOrdn()
    {
        return $this->ordn;
    }

    /**
     * @param array $prob
     * @return $this
     */
    public function setProb($prob)
    {
        $this->prob = $prob;
        return $this;
    }

    /**
     * @param Indi\Prob $prob
     * @return $this
     */
    public function addProb(Indi\Prob $prob)
    {
        $this->prob[] = $prob;
        return $this;
    }

    /**
     * @return array
     */
    public function getProb()
    {
        return $this->prob;
    }

    /**
     * @param array $reti
     * @return $this
     */
    public function setReti($reti)
    {
        $this->reti = $reti;
        return $this;
    }

    /**
     * @param Indi\Reti $reti
     * @return $this
     */
    public function addReti(Indi\Reti $reti)
    {
        $this->reti[] = $reti;
        return $this;
    }

    /**
     * @return array
     */
    public function getReti()
    {
        return $this->reti;
    }

    /**
     * @param array $will
     * @return $this
     */
    public function setWill($will)
    {
        $this->will = $will;
        return $this;
    }

    /**
     * @param Indi\Will $will
     * @return $this
     */
    public function addWill(Indi\Will $will)
    {
        $this->will[] = $will;
        return $this;
    }

    /**
     * @return array
     */
    public function getWill()
    {
        return $this->will;
    }

    /**
     * @param Indi\Asso $asso
     * @return $this
     */
    public function addAsso(Indi\Asso $asso)
    {
        $this->asso[] = $asso;
        return $this;
    }

    /**
     * @return array
     */
    public function getAsso()
    {
        return $this->asso;
    }

    /**
     * @param Indi\Refn $ref
     * @return $this
     */
    public function addRefn(Indi\Refn $ref)
    {
        $this->refn[] = $ref;
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
     * @param string $indi
     * @return $this
     */
    public function addAlia($indi)
    {
        $this->alia[] = $indi;
        return $this;
    }

    /**
     * @return array
     */
    public function getAlia()
    {
        return $this->alia;
    }

    /**
     * @param Indi\Famc $famc
     * @return $this
     */
    public function addFamc(Indi\Famc $famc)
    {
        $this->famc[] = $famc;
        return $this;
    }

    /**
     * @return array
     */
    public function getFamc()
    {
        return $this->famc;
    }

    /**
     * @param Indi\Fams $fams
     * @return $this
     */
    public function addFams(Indi\Fams $fams)
    {
        $this->fams[] = $fams;
        return $this;
    }

    /**
     * @return array
     */
    public function getFams()
    {
        return $this->fams;
    }

    /**
     * @param string $subm
     * @return $this
     */
    public function addAnci($subm)
    {
        $this->anci[] = $subm;
        return $this;
    }

    /**
     * @return array
     */
    public function getAnci()
    {
        return $this->anci;
    }

    /**
     * @param string $subm
     * @return $this
     */
    public function addDesi($subm)
    {
        $this->desi[] = $subm;
        return $this;
    }

    /**
     * @return array
     */
    public function getDesi()
    {
        return $this->desi;
    }

    /**
     * @param string $subm
     * @return $this
     */
    public function addSubm($subm)
    {
        $this->subm[] = $subm;
        return $this;
    }

    /**
     * @return array
     */
    public function getSubm()
    {
        return $this->subm;
    }

    /**
     * @param string $resn
     * @return $this
     */
    public function setResn($resn)
    {
        $this->resn = $resn;
        return $this;
    }

    /**
     * @return string
     */
    public function getResn()
    {
        return $this->resn;
    }

    /**
     * @param string $sex
     * @return $this
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param string $rfn
     * @return $this
     */
    public function setRfn($rfn)
    {
        $this->rfn = $rfn;
        return $this;
    }

    /**
     * @return string
     */
    public function getRfn()
    {
        return $this->rfn;
    }

    /**
     * @param string $afn
     * @return $this
     */
    public function setAfn($afn)
    {
        $this->afn = $afn;
        return $this;
    }

    /**
     * @return string
     */
    public function getAfn()
    {
        return $this->afn;
    }

    /**
     * @param Indi\Chan $chan
     * @return $this
     */
    public function setChan(Indi\Chan $chan)
    {
        $this->chan = $chan;
        return $this;
    }

    /**
     * @return Indi\Chan
     */
    public function getChan()
    {
        return $this->chan;
    }

    /**
     * @param string $rin
     * @return $this
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
     * @param Indi\Bapl $bapl
     * @return $this
     */
    public function setBapl(Indi\Bapl $bapl)
    {
        $this->bapl = $bapl;
        return $this;
    }

    /**
     * @return Indi\Bapl
     */
    public function getBapl()
    {
        return $this->bapl;
    }

    /**
     * @param Indi\Conl $conl
     * @return $this
     */
    public function setConl(Indi\Conl $conl)
    {
        $this->conl = $conl;
        return $this;
    }

    /**
     * @return Indi\Conl
     */
    public function getConl()
    {
        return $this->conl;
    }

    /**
     * @param Indi\Endl $endl
     * @return $this
     */
    public function setEndl(Indi\Endl $endl)
    {
        $this->endl = $endl;
        return $this;
    }

    /**
     * @return Indi\Endl
     */
    public function getEndl()
    {
        return $this->endl;
    }

    /**
     * @param Indi\Slgc $slgc
     * @return $this
     */
    public function setSlgc(Indi\Slgc $slgc)
    {
        $this->slgc = $slgc;
        return $this;
    }

    /**
     * @return Indi\Slgc
     */
    public function getSlgc()
    {
        return $this->slgc;
    }
}
