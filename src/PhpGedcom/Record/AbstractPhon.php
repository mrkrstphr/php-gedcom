<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractPhon
 * @package PhpGedcom\Record\Subm
 */
abstract class AbstractPhon extends Record
{
    /**
     * @var string
     */
    protected $phon = null;

    /**
     * @param $phon
     * @return Phon
     */
    public function setPhon($phon)
    {
        $this->phon = $phon;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhon()
    {
        return $this->phon;
    }
}
