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

namespace PhpGedcom\Record\Sour;

use \PhpGedcom\Record\Noteable;

/**
 *
 */
class Data extends \PhpGedcom\Record //implements Noteable
{
    /**
     * @var array
     * @of Data\Even
     */
    protected $even = array();

    /**
     * @var string
     */
    protected $agnc;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $text;
    
    /**
     * @var array
     * @of Data\Note
     */
    protected $note = array();

    /**
     * @param Data\Even $even
     * @return $this
     */
    public function addEven(Data\Even $even)
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
     * @param string $agnc
     * @return $this
     */
    public function setAgnc($agnc)
    {
        $this->agnc = $agnc;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgnc()
    {
        return $this->agnc;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

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
     * @param Data\Note $note
     * @return $this
     */
    public function addNote(Data\Note $note)
    {
        $this->note[] = $note;
        return $this;
    }

    /**
     * @return array
     */
    public function getNote()
    {
        return $this->note;
    }
}
