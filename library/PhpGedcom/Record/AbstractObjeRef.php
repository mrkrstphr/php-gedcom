<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractObjeRef
 * @package PhpGedcom\Record
 */
class AbstractObjeRef extends Record
{
    use NoteableTrait;

    /**
     * @var boolean
     */
    protected $isRef;

    /**
     * @var integer
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
    protected $file;

    /**
     *
     */
    public function setIsReference($isReference = true)
    {
        $this->isRef = $isReference;
    }

    /**
     *
     */
    public function getIsReference()
    {
        return $this->isRef;
    }

    /**
     * @param mixed $obje
     */
    public function setObje($obje)
    {
        $this->obje = $obje;
    }

    /**
     * @return mixed
     */
    public function getObje()
    {
        return $this->obje;
    }

    /**
     * @param string $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param string $titl
     */
    public function setTitl($titl)
    {
        $this->titl = $titl;
    }

    /**
     * @return string
     */
    public function getTitl()
    {
        return $this->titl;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
}
