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
     * @of AbstractObjeRef
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
     * @param AbstractObjeRef $obje
     * @return $this
     */
    public function addObje(AbstractObjeRef $obje)
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
