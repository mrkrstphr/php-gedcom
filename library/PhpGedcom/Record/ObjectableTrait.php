<?php

namespace PhpGedcom\Record;

/**
 * Class ObjectableTrait
 * @package PhpGedcom\Record
 */
trait ObjectableTrait
{
    /**
     * Stores an array of Object References for this object.
     *
     * @var array
     */
    protected $obje = array();

    /**
     * @param array $obje
     * @return $this
     */
    public function setObje(array $obje)
    {
        $this->obje = $obje;
        return $this;
    }

    /**
     * @param ObjeRef $obje
     * @return $this
     */
    public function addObje(ObjeRef $obje)
    {
        $this->obje[] = $obje;
        return $this;
    }

    /**
     * @return array
     */
    public function getObje()
    {
        return $this->obje;
    }
}
