<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractData
 * @package PhpGedcom\Record
 */
class AbstractData extends Record
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $date;

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
}

