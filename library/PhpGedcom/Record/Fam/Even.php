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
 * @license         MIT
 * @link            http://github.com/mrkrstphr/php-gedcom
 */

namespace PhpGedcom\Record\Fam;

use \PhpGedcom\Record\Objectable;
use \PhpGedcom\Record\Sourceable;
use \PhpGedcom\Record\Noteable;

/**
 *
 */
class Even extends \PhpGedcom\Record implements Objectable, Sourceable, Noteable
{
    protected $_type = null;
    protected $_date = null;
    protected $_plac = null;
    protected $_caus = null;
    protected $_age  = null;

    protected $_addr = null;

    protected $_phon = array();

    protected $_agnc = null;

    protected $_husb = null;
    protected $_wife = null;

    /**
     *
     */
    protected $_obje = array();

    /**
     *
     */
    protected $_sour = array();

    /**
     *
     */
    protected $_note = array();

    /**
     *
     */
    public function addPhon(\PhpGedcom\Record\Phon $phon)
    {
        $this->_phon[] = $phon;
    }

    /**
     *
     */
    public function addObje(\PhpGedcom\Record\ObjeRef $obje)
    {
        $this->_obje[] = $obje;
    }

    /**
     *
     */
    public function addSour(\PhpGedcom\Record\SourRef $sour)
    {
        $this->_sour[] = $sour;
    }

    /**
     *
     */
    public function addNote(\PhpGedcom\Record\NoteRef $note)
    {
        $this->_note[] = $note;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @return \PhpGedcom\Record\Indi\Even\Plac
     */
    public function getPlac()
    {
        return $this->_plac;
    }

    /**
     * @return array
     */
    public function getSour()
    {
        return $this->_sour;
    }

    /**
     * @return array
     */
    public function getNote()
    {
        return $this->_note;
    }

    /**
     * @return array
     */
    public function getObje()
    {
        return $this->obje;
    }

    /**
     * @return \PhpGedcom\Record\Addr
     */
    public function getAddr()
    {
        return $this->_addr;
    }

    /**
     * @return string
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @return string
     */
    public function getAgnc()
    {
        return $this->_agnc;
    }

    /**
     * @return string
     */
    public function getCaus()
    {
        return $this->_caus;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }
}
