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

/**
 * Class SourRef
 * @package PhpGedcom\Record
 */
class SourRef extends \PhpGedcom\Record
{
    /**
     * @var bool
     */
    protected $isRef = false;

    /**
     * @var integer
     */
    protected $sour;

    /**
     * @var string
     */
    protected $page;

    /**
     * @var string
     */
    protected $even;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var string
     */
    protected $quay;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var array
     */
    protected $obje = array();

    /**
     * @var array
     */
    protected $note = array();

    /**
     * @param boolean $isRef
     */
    public function setIsRef($isRef)
    {
        $this->isRef = $isRef;
    }

    /**
     * @return boolean
     */
    public function getIsRef()
    {
        return $this->isRef;
    }

    /**
     * @param int $sour
     */
    public function setSour($sour)
    {
        $this->sour = $sour;
    }

    /**
     * @return int
     */
    public function getSour()
    {
        return $this->sour;
    }

    /**
     * @param string $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string $even
     */
    public function setEven($even)
    {
        $this->even = $even;
    }

    /**
     * @return string
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $quay
     */
    public function setQuay($quay)
    {
        $this->quay = $quay;
    }

    /**
     * @return string
     */
    public function getQuay()
    {
        return $this->quay;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param ObjeRef $obje
     */
    public function addObje(ObjeRef $obje)
    {
        $this->obje[] = $obje;
    }

    /**
     * @param array $obje
     */
    public function setObje($obje)
    {
        $this->obje = $obje;
    }

    /**
     * @return array
     */
    public function getObje()
    {
        return $this->obje;
    }

    /**
     * @param NoteRef $note
     */
    public function addNote(NoteRef $note)
    {
        $this->note[] = $note;
    }

    /**
     * @param array $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return array
     */
    public function getNote()
    {
        return $this->note;
    }
}
