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
 *
 */
class Obje extends \PhpGedcom\Record implements Noteable
{
    /**
     * @var string
     */
    protected $obje;

    /**
     * @var string
     */
    protected $form;

    /**
     * @var string
     */
    protected $titl;

    /**
     * @var string
     */
    protected $blob;

    /**
     * @var string
     */
    protected $rin;

    /**
     * @var Obje/Chan
     */
    protected $chan;

    /**
     * @var array
     * @of Obje\Refn
     */
    protected $refn = array();
    
    /**
     * @var array
     * @of Obje\Note
     */
    protected $note = array();

    /**
     * @param string $obje
     * @return $this
     */
    public function setObje($obje)
    {
        $this->obje = $obje;
        return $this;
    }

    /**
     * @return string
     */
    public function getObje()
    {
        return $this->obje;
    }

    /**
     * @param string $titl
     * @return $this
     */
    public function setTitl($titl)
    {
        $this->titl = $titl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitl()
    {
        return $this->titl;
    }

    /**
     * @param string $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param \PhpGedcom\Record\Obje $chan
     * @return $this
     */
    public function setChan($chan)
    {
        $this->chan = $chan;
        return $this;
    }

    /**
     * @return \PhpGedcom\Record\Obje
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
     * @param string $blob
     * @return $this
     */
    public function setBlob($blob)
    {
        $this->blob = $blob;
        return $this;
    }

    /**
     * @return string
     */
    public function getBlob()
    {
        return $this->blob;
    }
    
    /**
     *
     */
    public function addRefn(\PhpGedcom\Record\Refn $refn)
    {
        $this->_refn[] = $refn;
    }
    
    /**
     *
     */
    public function addNote(\PhpGedcom\Record\NoteRef $note)
    {
        $this->_note[] = $note;
    }
}
