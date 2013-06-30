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
use PhpGedcom\Record\Note\Refn as RefnX;

/**
 * Class Note
 * @package PhpGedcom\Record
 */
class Note extends Record
{
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
    protected $note;

    /**
     * @var string
     */
    protected $even;

    /**
     * @var array
     * @of Refn
     */
    protected $refn = array();

    /**
     * @var string
     */
    protected $rin;

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \PhpGedcom\Record\Chan $chan
     */
    public function setChan($chan)
    {
        $this->chan = $chan;
    }

    /**
     * @return \PhpGedcom\Record\Chan
     */
    public function getChan()
    {
        return $this->chan;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
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
     * @param array $refn
     */
    public function setRefn(array $refn)
    {
        $this->refn = $refn;
    }

    /**
     * @param RefnX $refn
     */
    public function addRefn(RefnX $refn)
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
