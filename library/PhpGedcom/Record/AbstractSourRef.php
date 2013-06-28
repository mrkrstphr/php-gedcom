<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractSourRef
 * @package PhpGedcom\Record
 */
class AbstractSourRef extends Record
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
     * @var AbstractSourRefEven
     */
    protected $even;

    /**
     * @var Data
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
     * @of AbstractNoteRef
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
     * @param AbstractSourRefEven $even
     */
    public function setEven(AbstractSourRefEven $even)
    {
        $this->even = $even;
    }

    /**
     * @return AbstractSourRefEven
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
     * @param AbstractNoteRef $note
     */
    public function addNote(AbstractNoteRef $note)
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
