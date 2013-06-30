<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractRefn
 * @package PhpGedcom\Record
 */
abstract class AbstractRefn extends Record
{
    /**
     * @var string
     */
    protected $refn;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $refn
     * @return Refn
     */
    public function setRefn($refn)
    {
        $this->refn = $refn;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefn()
    {
        return $this->refn;
    }

    /**
     * @param string $type
     * @return Refn
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
