<?php

namespace PhpGedcomTest\Parser;

use PhpGedcom\Record;

/**
 * Class TestCustomTag
 * @package PhpGedcom\Parser
 */
class TestCustomTag extends Record
{
    /**
     * @var float
     */
    protected $long;

    /**
     * @var float
     */
    protected $lat;

    /**
     * @param float $long
     * @return $this
     */
    public function setLong($long)
    {
        $this->long = $long;
        return $this;
    }

    /**
     * @return float
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param float $lat
     * @return $this
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }
}
