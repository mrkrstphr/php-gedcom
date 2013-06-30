<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record\NoteableTrait;
use PhpGedcom\Record;

/**
 * Class AbstractChan
 * @package PhpGedcom\Record\Repo
 */
abstract class AbstractChan extends Record
{
    use NoteableTrait;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $time;

    /**
     * @param string $date
     * @return Chan
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
     * @param string $time
     * @return Chan
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }
}
